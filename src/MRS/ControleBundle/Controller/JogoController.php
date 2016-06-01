<?php

namespace MRS\ControleBundle\Controller;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use MRS\ControleBundle\Entity\Jogo;
use MRS\ControleBundle\Form\JogoType;

/**
 * Jogo controller.
 *
 * @Route("/jogo")
 */
class JogoController extends Controller
{

    /**
     * Lists all Jogo entities.
     *
     * @Route("/", name="jogo")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $logger = $this->get('logger');

        $logger->info($this->getUser()->getuserName() . ' 1 - Acessando');
        $logger->alert($this->getUser()->getuserName() . ' 2 - Acessando');
        $logger->warning($this->getUser()->getuserName() . ' 3 - Acessando');
        $logger->critical($this->getUser()->getuserName() . ' 4 - Acessando');
        $logger->emergency($this->getUser()->getuserName() . ' 5 - Acessando');
        $logger->debug($this->getUser()->getuserName() . ' 6 - Acessando');
        $logger->error($this->getUser()->getuserName() . ' 7 - Acessando');
        $logger->notice($this->getUser()->getuserName() . ' 8 - Acessando');


        $inicio = date('d-m-Y H:i:s');

        $entities = $this->getDoctrine()
                         ->getManager()
                         ->getRepository('MRSControleBundle:Jogo')
                         ->findAll();

        $fim = date('d-m-Y H:i:s');

        $entities = $this->get('knp_paginator')
                         ->paginate($entities,
                                    $request->query->getInt('page',1),
                                    10);

        return array(
            'entities' => $entities,
            'timer' => [ 'inicio' => $inicio, 'fim' => $fim]
        );
    }
    /**
     * Creates a new Jogo entity.
     *
     * @Route("/", name="jogo_create")
     * @Method("POST")
     * @Template("MRSControleBundle:Jogo:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Jogo();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('jogo_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Jogo entity.
     *
     * @param Jogo $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Jogo $entity)
    {
        $form = $this->createForm(JogoType::class, $entity, array(
            'action' => $this->generateUrl('jogo_create'),
            'method' => 'POST',
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Jogo entity.
     *
     * @Route("/new", name="jogo_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Jogo();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Jogo entity.
     *
     * @Route("/{id}", name="jogo_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MRSControleBundle:Jogo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Jogo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Jogo entity.
     *
     * @Route("/{id}/edit", name="jogo_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MRSControleBundle:Jogo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Jogo entity.');
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
    * Creates a form to edit a Jogo entity.
    *
    * @param Jogo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Jogo $entity)
    {
        $form = $this->createForm(JogoType::class, $entity, array(
            'action' => $this->generateUrl('jogo_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Jogo entity.
     *
     * @Route("/{id}", name="jogo_update")
     * @Method("PUT")
     * @Template("MRSControleBundle:Jogo:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MRSControleBundle:Jogo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Jogo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('jogo_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Jogo entity.
     *
     * @Route("/{id}", name="jogo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MRSControleBundle:Jogo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Jogo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('jogo'));
    }

    /**
     * Creates a form to delete a Jogo entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('jogo_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class, array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
