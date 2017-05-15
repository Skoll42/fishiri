<?php

namespace Application\Gullkysten\FishiriBundle\Service;

use FOS\UserBundle\Mailer\MailerInterface;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class EmailDispatcher
 * @package Application\Gullkysten\FishiriBundle\Service
 */
class EmailDispatcher implements MailerInterface
{
    protected $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param UserInterface $user
     */
    public function sendConfirmationEmailMessage(UserInterface $user)
    {
        $activationLink = $this->changeActivationLinkHost($this->container->get('router')->generate(
            'sonata_user_registration_confirm',
            ['token' => $user->getConfirmationToken()],
            true
        ));

        $confirmationText = $this->getConfirmationText($this->container->get('request')->request);
        $password = $user->getDefaultPassword();
        $message = \Swift_Message::newInstance()
            ->setSubject('You\'ve just registered to We Need To Talk')
            ->setFrom($this->container->getParameter('fishiri.email.from'))
            ->setTo($user->getEmail())
            ->setBody(
                $this->container->get('templating')->render('Email/registration.html.twig', [
                    'username' => $user->getUsername(),
                    'activationLink' => $activationLink,
                    'defaultPassword' => $password ? $password : null,
                    'confirmationText' => $confirmationText
                ]),
                'text/html'
            )
            ->addPart(
                $this->container->get('templating')->render('Email/registration.txt.twig', [
                    'username' => $user->getUsername(),
                    'activationLink' => $activationLink,
                    'defaultPassword' => $password ? $password : null,
                    'confirmationText' => $confirmationText
                ]),
                'text/plain'
            )
        ;
        $this->container->get('mailer')->send($message);
    }

    /**
     * @param $link
     * @return mixed
     */
    private function changeActivationLinkHost($link)
    {
        return preg_replace(
            '/(.*?:\/\/)(.*?)(\/.*)/i',
            '$1' . $this->container->getParameter('fishiri.email.host') . '$3',
            $link
        );
    }

    /**
     * Send an email to a user to confirm the password reset
     *
     * @param UserInterface $user
     *
     * @return void
     */
    public function sendResettingEmailMessage(UserInterface $user)
    {
        $url = $this
            ->container
            ->get('router')
            ->generate('sonata_user_admin_resetting_reset', ['token' => $user->getConfirmationToken()], true);
        $message = \Swift_Message::newInstance()
            ->setSubject('Password resetting for Fishiri')
            ->setFrom($this->container->getParameter('fishiri.email.from'))
            ->setTo($user->getEmail())
            ->setBody(
                $this->container->get('templating')->render('Email/resetting.html.twig', [
                    'confirmationUrl' => $url,
                    'user' => $user
                ]),
                'text/html'
            )
            ->addPart(
                $this->container->get('templating')->render('Email/resetting.txt.twig', [
                    'confirmationUrl' => $url,
                    'user' => $user
                ]),
                'text/plain'
            );
        $this->container->get('mailer')->send($message);
    }
}
