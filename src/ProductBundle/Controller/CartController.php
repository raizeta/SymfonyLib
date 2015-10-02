<?php

namespace ProductBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ProductBundle\Entity\Cart;
use ProductBundle\Form\CartType;

/**
 * Cart controller.
 *
 */
class CartController extends Controller
{

    /**
     * Lists all Cart entities.
     *
     */
    public function indexAction()
    {
        $user= $this->getUser()->getId();

        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery("SELECT p,c,u FROM ProductBundle:Cart c
                                                JOIN c.products p
                                                JOIN c.customer u WHERE (u.id=:id)"); 
                $query->setParameter('id',$user);    
        $entities = $query->getScalarResult();

        return $this->render('ProductBundle:Cart:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    
    /**
     * Creates a new Cart entity.
     *
     */
    public function createAction(Request $request,$id)
    {
        $user= $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();

        $product=$em->getRepository('ProductBundle:Product')->find($id);

        $query = $em->createQuery("SELECT p,c,u FROM ProductBundle:Cart c
                                                JOIN c.products p
                                                JOIN c.customer u WHERE (u.id=:id AND p.id=:productid)"); 
                $query->setParameter('id',$user);
                $query->setParameter('productid',$id);
        $result = $query->getResult();

        if($result)
        {
            foreach($result as $result)
            {
                $id         =$result->getId();
                $jumlah     =$result->getJumlah();
            }

            $jumlah=$jumlah+1;
            $cart=$em->getRepository('ProductBundle:Cart')->find($id);
            $cart->setJumlah($jumlah);
            $em->persist($cart);
            $em->flush();

        }
        else
        {
            $entity = new Cart();

            $entity->setCustomer($this->getUser());
            $entity->setJumlah(1);
            $entity->setProducts($product);
            $em->persist($entity);
            $em->flush();

                   
        }

        return $this->redirect($this->generateUrl('cart')); 

    }

    /**
     * Creates a form to create a Cart entity.
     *
     * @param Cart $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Cart $entity)
    {
        $form = $this->createForm(new CartType(), $entity, array(
            'action' => $this->generateUrl('cart_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Cart entity.
     *
     */
    public function newAction()
    {
        $entity = new Cart();
        $form   = $this->createCreateForm($entity);

        return $this->render('ProductBundle:Cart:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Cart entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ProductBundle:Cart')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cart entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ProductBundle:Cart:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Cart entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ProductBundle:Cart')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cart entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ProductBundle:Cart:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Cart entity.
    *
    * @param Cart $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Cart $entity)
    {
        $form = $this->createForm(new CartType(), $entity, array(
            'action' => $this->generateUrl('cart_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Cart entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ProductBundle:Cart')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cart entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('cart_edit', array('id' => $id)));
        }

        return $this->render('ProductBundle:Cart:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    /**
     * Deletes a Cart entity.
     *
     */
    public function deleteAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('ProductBundle:Cart')->find($id);

        if (!$entity) 
        {
            throw $this->createNotFoundException('Unable to find Cart entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('cart'));
    }

    /**
     * Creates a form to delete a Cart entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cart_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
