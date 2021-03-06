<?php

namespace T4webEmployees\Social;

use T4webBase\Domain\Entity;

class Social extends Entity {

    /**
     * @var integer
     */
    protected $employeeId;

    /**
     * @var string
     */
    protected $skype;

    /**
     * @var srting
     */
    protected $personalEmail;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $facebook;

    /**
     * @var string
     */
    protected $vk;

    /**
     * @var string
     */
    protected $linkedin;

    public function __construct(array $data = array()) {
        parent::__construct($data);
        $this->id = (int)$data['employeeId'];
    }

    public function getId() {
        return $this->employeeId;
    }

    /**
     * @return string
     */
    public function getSkype()
    {
        return $this->skype;
    }

    /**
     * @return srting
     */
    public function getPersonalEmail()
    {
        return $this->personalEmail;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * @return string
     */
    public function getVk()
    {
        return $this->vk;
    }

    /**
     * @return string
     */
    public function getLinkedin()
    {
        return $this->linkedin;
    }

}
