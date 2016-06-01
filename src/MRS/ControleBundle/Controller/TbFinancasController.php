<?php

namespace MRS\ControleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use MRS\ControleBundle\Entity\TbFinancas;
use MRS\ControleBundle\Form\TbFinancasType;
use Symfony\Component\HttpFoundation\Response;

/**
 * TbFinancas controller.
 *
 * @Route("/financas", defaults={"_locale":"pt_BR"}, requirements={"_locale":"pt_BR|en|fr"})
 */
class TbFinancasController extends Controller
{

    /**
     * Lists all TbFinancas entities.
     *
     * @Route("/", name="financas",defaults={"_locale":"pt_BR"})
     * @Method("GET|POST")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $date = new \DateTime();
        $datas[0] = ($request->get('dataInicial') == '') ? $date->modify('-30 day')->format('Y-m-d') : $request->get('dataInicial');

        $datas[1] = ($request->get('dataFinal') == '') ? date('Y-m-d') : $request->get('dataFinal');

        $entities = $this->get('financas.querynative')
                         ->listarDadosFinanceirosPorPeriodo($datas[0],$datas[1]);

        $entities = $this->get('knp_paginator')
                         ->paginate($entities,
                                    $request->query->getInt('page',1),
                                    2);

        return array(
            'entities' => $entities,
            'datas' => array('dataInicial' => $datas[0], 'dataFinal' => $datas[1]),
        );
    }
    /**
     * Creates a new TbFinancas entity.
     *
     * @Route("/create", name="financas_create")
     * @Method("POST")
     * @Template("MRSControleBundle:TbFinancas:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new TbFinancas();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('financas_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a TbFinancas entity.
     *
     * @param TbFinancas $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TbFinancas $entity)
    {
        $entity->setFinDataCadastro(new \DateTime('now'));
        $form = $this->createForm(new TbFinancasType(), $entity, array(
            'validation_groups' => array('create'),
            'action' => $this->generateUrl('financas_create'),
            'method' => 'POST',
        ));

       //$form->add('submit', 'submit', array('label' => 'Salvar', 'attr' => array('class' => 'btn btn-primary')));

        return $form;
    }

    /**
     * Displays a form to create a new TbFinancas entity.
     *
     * @Route("/new", name="financas_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new TbFinancas();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a TbFinancas entity.
     *
     * @Route("/{id}", name="financas_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MRSControleBundle:TbFinancas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbFinancas entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing TbFinancas entity.
     *
     * @Route("/{id}/edit", name="financas_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MRSControleBundle:TbFinancas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbFinancas entity.');
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
    * Creates a form to edit a TbFinancas entity.
    *
    * @param TbFinancas $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TbFinancas $entity)
    {
        $form = $this->createForm(new TbFinancasType(), $entity, array(
            'validation_groups' => array('update'),
            'action' => $this->generateUrl('financas_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        //$form->add('submit', 'submit', array('label' => 'Salvar', 'attr' => array('class' => 'btn btn-primary')));

        return $form;
    }
    /**
     * Edits an existing TbFinancas entity.
     *
     * @Route("/{id}", name="financas_update")
     * @Method("PUT")
     * @Template("MRSControleBundle:TbFinancas:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MRSControleBundle:TbFinancas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbFinancas entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('financas_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a TbFinancas entity.
     *
     * @Route("/{id}", name="financas_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MRSControleBundle:TbFinancas')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TbFinancas entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('financas'));
    }

    /**
     * Creates a form to delete a TbFinancas entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('financas_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

}
