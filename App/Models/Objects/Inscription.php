<?php

namespace Root\App\Models\Objects;

use InvalidArgumentException;

/**
 * 
 * @author Esaie MUHASA
 * 
 * Affiliation a un packet
 * ========================================
 *        
 */
class Inscription extends DBOccurence
{
    /**
     * @var User 
     */
    private $user;

    /**
     * @var Pack
     */
    private $pack;

    /**
     * le montant d'affiliation au packet
     * @var number
     */
    private $amount;

    /**
     * l'inscription predecesseur
     * @var Inscription
     */
    private $old;

    /**
     * le statut de l'inscription
     * @var boolean
     */
    private $state;

    /**
     * le code de la transaction
     * @var string
     */
    private $transactionCode;

    /**
     * l'origine de la transaction
     * @var string
     */
    private $transactionOrigi;

    /**
     * l'inscription est-elle deja valider par l'administrateur??
     * @var boolean
     */
    private $validate;
    /**
     * @var \DateTime
     */
    private $confirmationDate;

    /**
     * @var \DateTime
     */
    private $confirmationTime;

    /**
     * @return \Root\Models\Objects\User
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @return \Root\Models\Objects\Pack
     */
    public function getPack(): ?Pack
    {
        return $this->pack;
    }
/**
     * Revoie la refence vers l'administreateur qui aurait enregistre l'occurence
     * @return \Root\Models\Objects\Admin
     */
    public function getAdmin() : ?Admin
    {
        return $this->admin;
    }

    /**
     * @return number
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return \Root\Models\Objects\Inscription
     */
    public function getOld(): ?Inscription
    {
        return $this->old;
    }

    /**
     * @return boolean
     */
    public function isState()
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function getTransactionCode()
    {
        return $this->transactionCode;
    }

    /**
     * @return string
     */
    public function getTransactionOrigi()
    {
        return $this->transactionOrigi;
    }

    /**
     * @return boolean
     */
    public function isValidate(): ?bool
    {
        return $this->validate;
    }

    /**
     * @return bool|NULL
     */
    public function getValidate(): ?bool
    {
        return $this->isValidate();
    }

    /**
     * @return \DateTime
     */
    public function getConfirmationDate()
    {
        return $this->confirmationDate;
    }

    /**
     * @return \DateTime
     */
    public function getConfirmationTime()
    {
        return $this->confirmationTime;
    }

    /**
     * @param \Root\Models\Objects\User|string $user
     */
    public function setUser($user): void
    {
        if ($user instanceof User || $user == null) {
            $this->user = $user;
        } else if (is_string($user)) {
            // die($user);
            $this->user = new User(array('id' => $user));
        } else {
            throw new InvalidArgumentException("Le type de l'argument en parametre de la methode setUser() doit etre soit un string ou une instace de la classe User");
        }
    }

    /**
     * @param \Root\Models\Objects\Pack $pack
     */
    public function setPack($pack): void
    {
        if ($pack instanceof Pack || $pack == null) {
            $this->pack = $pack;
        } else if (is_string($pack)) {
            // die($pack);
            $this->pack = new Pack(array('id' => $pack));
        } else {
            throw new InvalidArgumentException("Le type de l'argument en parametre de la methode setPak() doit etre soit un string ou une instace de la classe Pack");
        }
       
    }

    /**
     * @param number $amount
     */
    public function setAmount($amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @param \Root\Models\Objects\Inscription $old
     */
    public function setOld($old): void
    {
        $this->old = $old;
    }

    /**
     * @param boolean $state
     */
    public function setState($state): void
    {
        $this->state = $state;
    }
    /**
     * aliace de @method isState()
     * @return bool|NULL
     */
    public function getState(): ?bool
    {
        return $this->isState();
    }

    /**
     * @param string $transactionCode
     */
    public function setTransactionCode($transactionCode): void
    {
        $this->transactionCode = $transactionCode;
    }

    /**
     * @param string $transactionOrigi
     */
    public function setTransactionOrigi($transactionOrigi): void
    {
        $this->transactionOrigi = $transactionOrigi;
    }

    /**
     * @param boolean $validate
     */
    public function setValidate($validate): void
    {
        $this->validate = $validate;
    }

    /**
     * @param \DateTime $confirmationDate
     */
    public function setConfirmationDate($confirmationDate): void
    {
        $this->confirmationDate = $confirmationDate;
    }

    /**
     * @param \DateTime $confirmationTime
     */
    public function setConfirmationTime($confirmationTime): void
    {
        $this->confirmationTime = $confirmationTime;
    }
}
