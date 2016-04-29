<?php

namespace MRS\ControleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use MRS\ControleBundle\Entity\TbHorario;
use MRS\ControleBundle\Form\TbHorarioType;
use Symfony\Component\HttpFoundation\Response;

/**
 * TbHorario controller.
 *
 * @Route("/horario")
 */
class TbHorarioController extends Controller
{

    /**
     * Lists all TbHorario entities.
     *
     * @Route("/", name="horario")
     * @Method("GET|POST")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $date = new \DateTime();

        $datasInicial = ($request->get('dataInicial') == '') ? $date->modify('-30 day')->format('Y-m-d') : $request->get('dataInicial');

        $datasFinal = ($request->get('dataFinal') == '') ? date('Y-m-d') : $request->get('dataFinal');

        $repository = $this->getDoctrine()->getManager()
                           ->getRepository('MRSControleBundle:TbHorario');

        $entities = $repository->listarByPeriod($datasInicial, $datasFinal);

        $entity = $repository->findByToday();

        $paginator = $this->get('knp_paginator')->paginate(
            $entities,
            $request->query->getInt('page',1),TbHorario::NUM_ITENS
        );

        return array(
            'entities' => $paginator,
            'entity' => $entity,
            'datas' => array('dataInicial' => $datasInicial, 'dataFinal' => $datasFinal),
        );
    }

    /**
     * Creates a new TbHorario entity.
     *
     * @Route("/", name="horario_create")
     * @Method("POST")
     * @Template("MRSControleBundle:TbHorario:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new TbHorario();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('horario_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a TbHorario entity.
     *
     * @param TbHorario $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TbHorario $entity)
    {
        $form = $this->createForm(new TbHorarioType(), $entity, array(
            'action' => $this->generateUrl('horario_create'),
            'method' => 'POST',
    ));

        $form->add('submit', 'submit', array('label' => 'Novo'));


        return $form;
    }

    /**
     * Displays a form to create a new TbHorario entity.
     *
     * @Route("/new", name="horario_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new TbHorario();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a TbHorario entity.
     *
     * @Route("/{id}", name="horario_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MRSControleBundle:TbHorario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbHorario entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing TbHorario entity.
     *
     * @Route("/{id}/edit", name="horario_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MRSControleBundle:TbHorario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbHorario entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a TbHorario entity.
    *
    * @param TbHorario $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TbHorario $entity)
    {
        $form = $this->createForm(new TbHorarioType(), $entity, array(
            'action' => $this->generateUrl('horario_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TbHorario entity.
     *
     * @Route("/{id}", name="horario_update")
     * @Method("PUT")
     * @Template("MRSControleBundle:TbHorario:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MRSControleBundle:TbHorario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbHorario entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->addFlash('notice','Atualizado com sucesso!');

            return $this->redirect($this->generateUrl('horario_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a TbHorario entity.
     *
     * @Route("/{id}", name="horario_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MRSControleBundle:TbHorario')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TbHorario entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('horario'));
    }

    /**
     * Creates a form to delete a TbHorario entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('horario_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }


}
