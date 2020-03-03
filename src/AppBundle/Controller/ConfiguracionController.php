<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\File\File;
use AppBundle\Imagen\ResizeImage;

/**
 * Configuracion controller.
 *
 * @Route("configuracion")
 */
class ConfiguracionController extends Controller
{

    /**
     * Displays a form to edit an existing empresaLocal entity.
     *
     * @Route("/edit", name="configuracion_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction(Request $request)
    {
    	  $em = $this->getDoctrine()->getManager();
        $session        = $request->getSession();
        $local          = $session->get('local');
        $empresa        = $session->get('empresa');        
        $rol            = $session->get('rol');

        $empresaObj = $em->getRepository('AppBundle:Empresa')->find($empresa);

        $param = array('empresa'=>$empresa);

        $originalFileProducto = null;

        // if($empresaLocal->getImagenProductoDefault()){

        //     $originalFileProducto = $empresaLocal->getImagenProductoDefault();

        //     $empresaLocal->setImagenProductoDefault(
        //         new File($this->getParameter('imagenes_directorio').'/100x100/'.$empresaLocal->getImagenProductoDefault())
        //     );
        // }

        $originalFileCategoria = null;

        // if($empresaLocal->getImagenCategoriaDefault()){

        //     $originalFileCategoria = $empresaLocal->getImagenCategoriaDefault();

        //     $empresaLocal->setImagenCategoriaDefault(
        //         new File($this->getParameter('imagenes_directorio').'/100x100/'.$empresaLocal->getImagenCategoriaDefault())
        //     );
        // }

        $originalFileLogo = null;

        if($empresaObj->getLogo()){

            $originalFileLogo = $empresaObj->getLogo();

            $empresaObj->setLogo(
                new File($this->getParameter('imagenes_directorio').'/'.$empresaObj->getLogo())
            );
        }

        $editForm = $this->createForm('AppBundle\Form\ConfiguracionType', $empresaObj,$param);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {


            //Guadamos el logo
            $fileLogo = $empresaObj->getLogo();

            if($fileLogo){

                $fileNameLogo = $this->generateUniqueFileName().'.'.$fileLogo->guessExtension();

                $fileLogo->move(
                    $this->getParameter('imagenes_directorio'),
                    $fileNameLogo
                );


                $empresaObj->setLogo($fileNameLogo);

                $rutaLogo = $this->getParameter('imagenes_directorio').'/'.$fileNameLogo;

                $this->redimensionarImagen($fileNameLogo);               

            }else{

                $empresaObj->setLogo($originalFileLogo);
            }

            $em->persist($empresaObj);



            try {

                $em->flush();
                $this->addFlash("success","El registro fue guardado exitosamente.");

            } catch (\Exception $e) {

                $this->addFlash("danger", $e." Ocurrió un error inesperado, el registro no se guardó.");
                return $this->redirectToRoute('configuracion_edit');                
            }


            return $this->redirectToRoute('configuracion_edit');
        }

        return $this->render('configuracion/edit.html.twig', array(
            'edit_form' => $editForm->createView(),
            'titulo'   => 'Configuración',
            'originalFileProducto' => $originalFileProducto,
            'originalFileCategoria' => $originalFileCategoria,
            'originalFileLogo'	=> $originalFileLogo
        ));
    }


    private function redimensionarImagen($fileName)
    {

        //Creamos el tumbnail 320x80
        $resize = new ResizeImage($this->getParameter('imagenes_directorio').'/'.$fileName);
        $resize->resizeTo(320, 80, 'exact');
        $resize->saveImage($this->getParameter('imagenes_directorio').'/'.$fileName);

        //Creamos la imagen en  500x500
        // $resize = new ResizeImage($this->getParameter('imagenes_directorio').'/'.$fileName);
        // $resize->resizeTo(500, 500, 'exact');
        // $resize->saveImage($this->getParameter('imagenes_directorio').'/500x500/'.$fileName);

        //unlink($this->getParameter('imagenes_directorio').'/'.$fileName);  

        return true;

    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }

}