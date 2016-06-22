<?php

namespace MRS\ControleBundle\Controller;

use MRS\ControleBundle\MRSControleBundle;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use MRS\ControleBundle\Entity\TbCategoria;
use MRS\ControleBundle\Form\TbCategoriaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * TbCategoria controller.
 *
 * @Route("/categoria")
 */
class TbCategoriaController extends Controller
{

    /**
     * Lists all TbCategoria entities.
     *
     * @Route("/", name="categoria")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MRSControleBundle:TbCategoria')->findAll();

        $entities = $this->get('knp_paginator')->paginate(
            $entities,
            $request->query->getInt('page',1),
            5
        );

        return array(
            'entities' => $entities,
            'pageName' => 'Listar'
        );
    }
    /**
     * Creates a new TbCategoria entity.
     *
     * @Route("/", name="categoria_create")
     * @Method("POST")
     * @Template("MRSControleBundle:TbCategoria:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new TbCategoria();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('categoria_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'pageName' => 'Nova'
        );
    }

    /**
     * Creates a form to create a TbCategoria entity.
     *
     * @param TbCategoria $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TbCategoria $entity)
    {
        $form = $this->createForm(new TbCategoriaType(), $entity, array(
            'validation_groups' => array('create'),
            'action' => $this->generateUrl('categoria_create'),
            'method' => 'POST',
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Salvar', 'attr' => array('class' => 'btn btn-primary')));

        return $form;
    }

    /**
     * Displays a form to create a new TbCategoria entity.
     *
     * @Route("/new", name="categoria_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new TbCategoria();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'pageName' => 'Nova'
        );
    }

    /**
     * Finds and displays a TbCategoria entity.
     *
     * @Route("/{id}", name="categoria_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MRSControleBundle:TbCategoria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbCategoria entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'pageName' => 'Mostrar'
        );
    }

    /**
     * Displays a form to edit an existing TbCategoria entity.
     *
     * @Route("/{id}/edit", name="categoria_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MRSControleBundle:TbCategoria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbCategoria entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'pageName' => 'Editar'
        );
    }

    /**
    * Creates a form to edit a TbCategoria entity.
    *
    * @param TbCategoria $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TbCategoria $entity)
    {
        $form = $this->createForm(new TbCategoriaType(), $entity, array(
            'validation_groups' => array('update'),
            'action' => $this->generateUrl('categoria_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Salvar','attr' => ['class' => 'btn btn-primary']));

        return $form;
    }
    /**
     * Edits an existing TbCategoria entity.
     *
     * @Route("/{id}", name="categoria_update")
     * @Method("PUT")
     * @Template("MRSControleBundle:TbCategoria:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MRSControleBundle:TbCategoria')->find($id);
        $entity->setCatAtivo(1);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbCategoria entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('categoria_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'pageName' => 'Nova'
        );
    }
    /**
     * Deletes a TbCategoria entity.
     *
     * @Route("/{id}", name="categoria_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MRSControleBundle:TbCategoria')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TbCategoria entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('categoria'));
    }

    /**
     * Creates a form to delete a TbCategoria entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('categoria_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class, array('label' => 'Remover',
                'attr' => ['class' => 'btn btn-danger']))
            ->getForm()
        ;
    }
}
