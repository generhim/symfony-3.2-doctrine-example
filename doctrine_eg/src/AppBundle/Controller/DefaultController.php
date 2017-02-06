<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Account;
use Symfony\Component\HttpFoundation\Response;
use \date;
use \time;
use \DateTime;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // NOTE: We have two fields that are datetime. In doctrine, datetime fields require the php DateTime object
        //      in order to process correctly. Otherwise if you use the date() function it will fail because the
        //      value being passed is a string, not a DateTime object.
        $myDate          = date('Y-m-d H:i:s');
        $dateTimeObj     = new DateTime($myDate);

        $account = new Account();
        $account->setFirstName('Jyn');
        $account->setLastName('Erso');
        $account->setEmailAddress('gottaGetThePlans@deathstar.com');
        $account->setAccountPassword('whatchaGonnaDo');
        $account->setCreateDate($dateTimeObj);
        $account->setModifiedDate($dateTimeObj);
        $account->setAccountStatus(1);

        $entityManager = $this->getDoctrine()->getManager();

        // save the $account object for the time being.
        $entityManager->persist($account);

        // perform the insert.
        $entityManager->flush();

        $header_text = $this->retrieve_header();
        $purpose = "<br/><br/>The purpose of this controller method, indexAction, is to <ol><li>Set the Date Object</li><li>set a new Account() data object from the Doctrine entity directory</li><li> and then using the entityManager save the data object into the database,</li><li>Then follow-up and clean everything up by clearing the data from the entityManager,</li><li>And finally passing the results back using a Response object</li></ol>";


        return new Response( $header_text . 'date:' . $myDate . $purpose);
    }


    private function retrieve_header()
    {
        return "<h1>Doctrine ORM examples</h1>
                <ol>
                    <li><strong>CREATE</strong>
                        <ol>
                        <li><a href=\"http://symfony-doctrine.examples.rhim.org/\">Insert Data</a></li>
                        </ol>
                    </li>
                    <li><strong>RETRIEVE</strong>
                        <ol>
                        <li><a href=\"http://symfony-doctrine.examples.rhim.org/retrieve_one\">Retrieve One Record (as an object)</a></li>
                        <li><a href=\"http://symfony-doctrine.examples.rhim.org/retrieve_fields/1\">Retrieve Record Fields by Id</a></li>
                        </ol>
                    </li>
                    <li><strong>UPDATE</strong>
                        <ol>
                        <li><a href=\"http://symfony-doctrine.examples.rhim.org/update\">Update Record with timestamp and then redirect</a></li>
                        </ol>
                    </li>
                    <li><strong>DELETE</strong>
                        <ol>
                        <li><a href=\"http://symfony-doctrine.examples.rhim.org/delete\">Delete last record</a></li>
                        </ol>
                    </li>
                </ol>";
    }


    /**
     * @Route("/retrieve_one", name="retrieve_one")
     */
    public function retrieveOneRecordAction()
    {

        $firstName = "Jyn";
        $id = 1;
        $data = $this->getDoctrine()->getRepository('AppBundle:Account')->find($id);

        if(!$data){
            throw $this->createNotFoundException('No data found for this id:' . $id);
        }

        /*
            This Response object will return the following data object:

                AppBundle\Entity\Account::__set_state(array(
                   'id' => 1,
                   'firstName' => 'Jyn',
                   'lastName' => 'Erso',
                   'emailAddress' => 'gottaGetThePlans@deathstar.com',
                   'accountPassword' => 'whatchaGonnaDo',
                   'createDate' =>
                  DateTime::__set_state(array(
                     'date' => '2016-12-12 00:00:00.000000',
                     'timezone_type' => 3,
                     'timezone' => 'Europe/Zurich',
                  )),
                   'modifiedDate' =>
                  DateTime::__set_state(array(
                     'date' => '2016-12-12 00:00:00.000000',
                     'timezone_type' => 3,
                     'timezone' => 'Europe/Zurich',
                  )),
                   'accountStatus' => 1,
                ))

                NOTE: You will see that this entity object uses the DateTime class to hold the data.
        */
        //return new Response('<pre>'.var_export($data, TRUE));
        return new Response($this->retrieve_header() . '<pre>'.var_export($data, TRUE));

    }


    /**
     * Example url: http://localhost:8000/retrieve_fields/1
     *
     * @Route("/retrieve_fields/{id}", name="retrieve_fields")
     */
    public function retrieveFieldsAction($id)
    {

        $myId = $id ? $id : 1;
        $data = $this->getDoctrine()->getRepository('AppBundle:Account')->find($myId);

        if(!$data){
            throw $this->createNotFoundException('No data found for this id:' . $myId);
        }

        // Now that we have retrieved the data object we can use the getters to retrieve the data we want.
        //return new Response('The name of the gal who helped steal the Death Star plans was: ' . $data->getFirstName() . ' ' . $data->getLastName());
        return new Response($this->retrieve_header() . 'The name of the gal who helped steal the Death Star plans was: ' . $data->getFirstName() . ' ' . $data->getLastName());

    }

    /**
     * Example url: http://localhost:8000/retrieve_by_id/1
     *
     * @Route("/retrieve_by_id", name="retrieve_by_id")
     */
    public function retrieveByIdAction($accountId)
    {
        $acct = $this->getDoctrine()->getRepository('AppBundle:Account')->find($accountId);

            if(!$acct)
            {
                throw $this->createNotFoundException('No data found for this id:' . $id);
            }

                //return new Response('The name of the gal who helped steal the Death Star plans was: ' . $acct->getFirstName() . ' ' . $acct->getLastName());
                return new Response($this->retrieve_header() . 'The name of the gal who helped steal the Death Star plans was: ' . $acct->getFirstName() . ' ' . $acct->getLastName());
    }


    /**
     * Example url: http://localhost:8000/retrieve_by_first_name/Jyn
     *
     * @Route("/retrieve_by_first_name/{firstName}", name="retrieve_by_first_name")
     */
    public function retrieveByFirstName($firstName)
    {
        $myFirstName = $firstName ? $firstName : 'Jyn';

        $acct = $this->getDoctrine()->getRepository("AppBundle:Account")->findOneByFirstName($myFirstName);

            if(!$acct)
            {
                throw $this->createNotFoundException('No data found for this name:' . $firstName);
            }

                return new Response('The name of the gal who helped steal the Death Star plans was: ' . $acct->getFirstName() . ' ' . $acct->getLastName());

    }

    /**
     * Example url: http://localhost:8000/retrieve_by_multiple/Jyn/0
     *
     * @Route("/retrieve_by_multiple/{firstName}/{status}", name="retrieve_by_first_name")
     */
    public function retrieveByMultiple($firstName, $status)
    {
        $myFirstName = $firstName ? $firstName : 'Jyn';
        $myStatus    = $status ? $status : 0;

        $queryArray  = array('firstName' => $myFirstName, 'accountStatus' => $myStatus);

        $acct = $this->getDoctrine()->getRepository("AppBundle:Account")->findOneBy($queryArray);

        if(!$acct)
        {
            throw $this->createNotFoundException('No data found for this name:' . $firstName);
        }

        return new Response('The name of the gal who helped steal the Death Star plans was: ' . $acct->getFirstName() . ' ' . $acct->getLastName() . ' - record id: ' . $acct->getId());

    }


    /**
     * @Route("/update", name="update")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function updateAction()
    {

        $userId = 1;
        $myDate          = date('Y-m-d H:i:s');
        $dateTimeObj     = new DateTime($myDate);

        $entityManager  = $this->getDoctrine()->getManager();
        $acct           = $entityManager->getRepository('AppBundle:Account')->find($userId);

        if (!$acct) {
            throw $this->createNotFoundException(
                'No account found for id '.$userId
            );
        }

        // persist the data...
        $acct->setFirstName('K2SO friend');
        $acct->setModifiedDate($dateTimeObj);


        // Notice that calling $em->persist($acct) isn't necessary. Recall that this method simply tells Doctrine to
        // manage or "watch" the $product object. In this case, since you fetched the $acct object from Doctrine,
        // it's already managed.


        // perform the update
        $entityManager->flush();

        return $this->redirectToRoute('afterUpdate'); // after update redirect to afterUpdate method.

    }


    /**
     * @Route("/after_update", name="afterUpdate")
     */
    public function afterUdateAction()
    {
        $userId = 1;
        $entityManager  = $this->getDoctrine()->getManager();
        $acct           = $entityManager->getRepository('AppBundle:Account')->find($userId);

        //return new Response("There first name is now: " . $acct->getFirstName() . " and the modified date is: " . $acct->getModifiedDate()      );
        return new Response( $this->retrieve_header() . "There first name is now: " . $acct->getFirstName() . " and the modified date is: " . $acct->getModifiedDate()      );
    }


    /**
     * @Route("/delete", name="delete")
     */
    public function deleteAction()
    {

        $em = $this->getDoctrine()->getManager();

        // First retrieve object
        $query = $em->createQuery(
            'SELECT a
          FROM AppBundle:Account a
          ORDER BY a.id DESC'
        );
        $account = $query->getResult();
        $lastId  = $account[0]->getId();

        // Then pass id (integer) to retrieve the object we want to delete.
        $acct           = $em->getRepository('AppBundle:Account')->find($lastId);
        $em->remove($acct);

        // The actual DELETE query, however, isn't actually executed until the flush() method is called.
        $em->flush();

        //return new Response("Delete action taken... It should be deleted from the database.");
        return new Response($this->retrieve_header() . "Delete action taken on record id#: " . $lastId . " - It should be deleted from the database.");

    }


    /**
     * @Route("/dql_example", name="dql_example")
     */
    public function dql_exampleAction()
    {

        $myDate          = date('Y-m-d H:i:s');
        $dateTimeObj     = new DateTime($myDate);
        $id = 5;

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
        'SELECT a
          FROM AppBundle:Account a
          WHERE a.id = :Id
          ORDER BY a.id ASC'
        )->setParameter('Id', $id);

        $account = $query->getResult();

        return new Response("Modified record id #" . $id . ".." . $account[0]->getFirstName() . ' ' . $account[0]->getLastName());

    }

}
/* EOF */