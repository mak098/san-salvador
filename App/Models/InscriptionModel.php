<?php

namespace Root\App\Models;

use Root\App\Models\Objects\Inscription;

class InscriptionModel extends AbstractDbOccurenceModel
{
    /**
     * {@inheritDoc}
     * @see \Root\Models\AbstractDbOccurenceModel::create()
     * @param Inscription $object
     */
    public function create($object): void
    {
        Queries::addData(

            $this->getTableName(),
            [
                Schema::INSCRIPTION['id'],
                Schema::INSCRIPTION['user'],
                Schema::INSCRIPTION['packId'],
                Schema::INSCRIPTION['amount'],
                Schema::INSCRIPTION['state'],
                Schema::INSCRIPTION['transactionOrigin'],
                Schema::INSCRIPTION['transactionCode'],
                Schema::INSCRIPTION['recordDate'],
                Schema::INSCRIPTION['recordTime']
            ],
            [
                $object->getId(),
                $object->getUser()->getId(),
                $object->getPack()->getId(),
                $object->getAmount(),
                $object->getState() ? 1 : 0,
                $object->getTransactionOrigi(),
                $object->getTransactionCode(),
                $object->getRecordDate()->format('Y-m-d'),
                $object->gettimeRecord()->format('H:i:s')
            ]
        );
    }
    /**
     * recuperation des occurences
     */
    protected function getDBOccurence(array $keyValue)
    {
        $data = array();
        foreach (Schema::INSCRIPTION as $key => $value) {
            if (key_exists($value, $keyValue)) {
                $data[$key] = $keyValue[$value];
            }
        }
        return new Inscription($data);
    }
    /**
     * {@inheritDoc}
     * @see \Root\App\Models\AbstractDbOccurenceModel::getTableName()
     */
    protected function getTableName(): string
    {
        return Schema::TABLE_SCHEMA['inscription'];
    }

    public function update($object, $id): void
    {
        throw new ModelException("Operation non pris en charge");
    }
    /**
     * {@inheritDoc}
     * @see \Root\Models\AbstractDbOccurenceModel::update()
     * @param Inscription $object
     */
    public function validate($object, $id): void{
        Queries::updateData(
            $this->getTableName(),            [
                
                Schema::INSCRIPTION['state'],
                Schema::INSCRIPTION['validateInscription'],
                Schema::INSCRIPTION['adminId'],
                Schema::INSCRIPTION['confirmatDate'],
                Schema::INSCRIPTION['confirmateTime'],
                Schema::INSCRIPTION['modifDate'],
                Schema::INSCRIPTION['motifTime']
            ],
            "id=?",
            [
                $object->getState() ? 1 : 0,
                $object->getValidate() ? 1 : 0,
                $object->getAdmin(),                
                $object->getConfirmationDate()->format('Y-m-d'),
                $object->getConfirmationTime()->format('H:i:s'),
                $object->getLastModifDate()->format('Y-m-d'),
                $object->getLastModifTime()->format('H:i:s'),
                $object->getId()
            ]
        );
    }

    /**
     * verifie s'il existe une inscription a un pack activé
     * @return bool
     */
    public function checkValidated($userId=null): bool
    {
        $return = false;
        try {
            $statement="";
            $user = Schema::INSCRIPTION['user'];
            $state = Schema::INSCRIPTION['validateInscription'];
            if(is_null($userId)){
                $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE  {$state}=?", array($userId, 1));
            }else{
                $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE  {$user}=? AND {$state}=?", array($userId, 1));
            }
            if ($statement->fetch()) {
                $return = true;
            }
            $statement->closeCursor();
        } catch (\PDOException $e) {
            throw new ModelException("Une erreur est survenue lors de la communication avec la BDD", intval($e->getCode(), 10), $e);
        }

        return $return;
    }
    /**
     * verifie s'il existe une inscription a un a pack en  attente d'acivation
     * @return bool
     */
    public function checkAwait($userId=null): bool
    {
        $return = false;
        try {
            $statement ="";
            $user = Schema::INSCRIPTION['user'];
            $state = Schema::INSCRIPTION['validateInscription'];
            if(is_null($userId)){
                $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE {$state}=?", array($userId, 0));
            }
            else{
                $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE  {$user}=? AND {$state}=?", array($userId, 0));
             }            
            if ($statement->fetch()) {
                $return = true;
            }
            $statement->closeCursor();
        } catch (\PDOException $e) {
            throw new ModelException("Une erreur est survenue lors de la communication avec la BDD", intval($e->getCode(), 10), $e);
        }

        return $return;
    }
    /**
     * revoie tout les informations des souscription en attante de validation
     * @throws ModelException
     * @return array
     */
    public function findAwait($userId=null): array
    {
        $return = array();
        try {
            $statement="";
            $user = Schema::INSCRIPTION['user'];
            $validation = Schema::INSCRIPTION['validateInscription'];
            if(is_null($userId)){
                $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE { $validation}=?", array(0));
            }else{
                $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE {$user}=? { $validation}=?", array($userId,0));
            }            
            if ($row = $statement->fetch()) {
                $return[] = new INSCRIPTION($row);
                while ($row = $statement->fetch()) {
                    $return[] = new INSCRIPTION($row);
                }
                $statement->closeCursor();
            } else {
                $statement->closeCursor();
                $return = $return;
            }
        } catch (\PDOException $e) {
            throw new ModelException("Une erreur est survenue lors de la communication avec la BDD", intval($e->getCode()), $e);
        }
        return $return;
    }
    /**
     * revoie tout les informations des souscription deja valide
     * @param string $userId
     * @param int $limit
     * @param int $offset
     * @throws ModelException
     * @return array
     */
    public function findValidated( $userId=null,?int $limit = null, int $offset = 0): array
    {
        $return = array();
        try {
            $user = Schema::INSCRIPTION['user'];
            $validation = Schema::INSCRIPTION['validateInscription'];
            if(is_null($userId)){
                $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE { $validation}=?". ($limit != null ? "LIMIT {$limit} OFFSET {$offset}" : ""), array($userId, 1));
            }else{
                $statement = Queries::executeQuery("SELECT * FROM {$this->getTableName()} WHERE { $user}=? AND  { $validation}=?". ($limit != null ? "LIMIT {$limit} OFFSET {$offset}" : ""), array($userId, 1));
            }
            if ($row = $statement->fetch()) {
                $return[] = new INSCRIPTION($row);
                while ($row = $statement->fetch()) {
                    $return[] = new INSCRIPTION($row);
                }
                $statement->closeCursor();
            } else {
                $statement->closeCursor();
                $return = $return;
            }
        } catch (\PDOException $e) {
            throw new ModelException("Une erreur est survenue lors de la communication avec la BDD", intval($e->getCode()), $e);
        }
        return $return;
    }
}
