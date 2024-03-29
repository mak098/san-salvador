<?php

namespace Root\App\Models;

use Root\App\Models\Queries;
use Root\App\Models\Objects\ReturnInvest;
use Root\App\Models\Schema;
use Root\App\Models\AbstractOperationModel;

class ReturnInvestModel extends ReturnInvest
{

    /**
     * La methode create permet l'insertion d'une nouvelle occurence data la table ReturnInvest
     * il prend a paramettre une objet ReturnInvest
     * {@inheritDoc}
     * @see \Root\Models\AbstractDbOccurenceModel::create()
     * @param ReturnInvest $object
     */
    public function create($object): void
    {
        $ReturnInvest = Schema::RETURN_INVEST;
        Queries::addData(
            $this->getTableName(),
            [
                $ReturnInvest['id'],
                $ReturnInvest['inscriptionId'],
                $ReturnInvest['amount'],
                $ReturnInvest['recordDate'],
                $ReturnInvest['timeRecord'],
                $ReturnInvest['surplus'],
            ],
            [
                $object->getId(),
                $object->getInscription(),
                $object->getAmount(),
                $object->getRecordDate(),
                $object->gettimeRecord(),
                $object->getSurplus()
            ]
        );
    }

    /**
     * {@inheritDoc}
     * @see \Root\Models\AbstractDbOccurenceModel::getTableName()
     */
    protected function getTableName(): string
    {
        return Schema::TABLE_SCHEMA['returnInvest'];
    }

    /**
     * {@inheritDoc}
     * @see \Root\Models\AbstractDbOccurenceModel::getDBOccurence()
     */
    protected function getDBOccurence(array $keyValue)
    {
        $data = array();
        foreach (Schema::RETURN_INVEST  as $key => $value) {
            if (key_exists($value, $keyValue)) {
                $data[$key] = $keyValue[$key];
            }
        }
        return new ReturnInvest($data);
    }

    /**
     * {@inheritDoc}
     * @see \Root\Models\AbstractOperationModel::getFieldsNames()
     */
    protected function getFieldsNames(): array
    {
        return Schema::RETURN_INVEST;
    }
}
