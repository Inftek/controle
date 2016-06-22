<?php

namespace MRS\ControleBundle\Controller;

use Symfony\Component\BrowserKit\Tests\ClientTest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use MRS\ControleBundle\Entity\TbKilometragem;
use MRS\ControleBundle\Form\TbKilometragemType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * TbKilometragem controller.
 *
 * @Route("/kilometragem")
 */
class TbKilometragemController extends Controller
{

    /**
     * Lists all TbKilometragem entities.
     *
     * @Route("/", name="kilometragem")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {

        $entityUser = $this->getDoctrine()
                           ->getRepository('MRSControleBundle:TbKilometragem')
                           ->getCalcKilometragem();

        $entityUser = $this->get('knp_paginator')
                           ->paginate($entityUser,
                                      $request->query->getInt('page',1),
                                      TbKilometragem::NUM_LIMT);

        return array(
            'entityUser' => $entityUser
        );
    }
    /**
     * Creates a new TbKilometragem entity.
     *
     * @Route("/", name="kilometragem_create")
     * @Method("POST")
     * @Template("MRSControleBundle:TbKilometragem:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new TbKilometragem();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        //$this->container->get('validator')->validate($entity,null,array('create'));

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('kilometragem_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a TbKilometragem entity.
     *
     * @param TbKilometragem $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TbKilometragem $entity)
    {
        $form = $this->createForm(TbKilometragemType::class, $entity, array(
            'validation_group' => array('create'),
            'action' => $this->generateUrl('kilometragem_create'),
            'method' => 'POST',
        ));

        //$form->add('submit', 'submit');

        return $form;

    }

    /**
     * Displays a form to create a new TbKilometragem entity.
     *
     * @Route("/new", name="kilometragem_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $date = new \DateTime('now');

        $entity = new TbKilometragem();
        $entity->setKiDataInicial($date)
               ->setKiDataAtual($date);

        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a TbKilometragem entity.
     *
     * @Route("/{id}", name="kilometragem_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MRSControleBundle:TbKilometragem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbKilometragem entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing TbKilometragem entity.
     *
     * @Route("/{id}/edit", name="kilometragem_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MRSControleBundle:TbKilometragem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbKilometragem entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'errors' => 'true'
        );
    }

    /**
    * Creates a form to edit a TbKilometragem entity.
    *
    * @param TbKilometragem $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TbKilometragem $entity)
    {
        $form = $this->createForm(TbKilometragemType::class, $entity, array(
            'validation_group' => array('update'),
            'action' => $this->generateUrl('kilometragem_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', SubmitType::class, ['label' => 'Salvar',
                                        'attr' => ['class' => 'btn btn-primary']
                                        ]);

        return $form;
    }
    /**
     * Edits an existing TbKilometragem entity.
     *
     * @Route("/{id}", name="kilometragem_update")
     * @Method("PUT")
     * @Template("MRSControleBundle:TbKilometragem:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MRSControleBundle:TbKilometragem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbKilometragem entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        $errors = $this->container->get('validator')->validate($editForm,null,array('create'));

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('kilometragem_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'errors' => $errors
        );
    }
    /**
     * Deletes a TbKilometragem entity.
     *
     * @Route("/{id}", name="kilometragem_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MRSControleBundle:TbKilometragem')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TbKilometragem entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('kilometragem'));
    }

    /**
     * Creates a form to delete a TbKilometragem entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('kilometragem_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class)
            ->getForm()
        ;
    }
}
