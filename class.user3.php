<?php

	require("abstract.databoundobject.php");

class User extends DataBoundObject {
    protected function DefineTableName() {
        return 'user_table';
    }

    protected function DefineRelationMap() {
        return array(
            'id' => 'ID',
            'first_name' => 'FirstName',
            'last_name' => 'LastName',
            'date_account_created' => 'DateAccountCreated'
        );
    }

    public function Update() {
        if (isset($this->ID)) {
            $strQuery = 'UPDATE "' . $this->strTableName . '" SET ';
            foreach ($this->arRelationMap as $key => $value) {
                eval('$actualVal = &$this->' . $value . ';');
                if (array_key_exists($value, $this->arModifiedRelations)) {
                    $strQuery .= '"' . $key . "\" = :$value, ";
                }
            }
            $strQuery = rtrim($strQuery, ', ');
            $strQuery .= ' WHERE "id" = :eid';
            $objStatement = $this->objPDO->prepare($strQuery);
            $objStatement->bindValue(':eid', $this->ID, PDO::PARAM_INT);
            foreach ($this->arRelationMap as $key => $value) {
                eval('$actualVal = &$this->' . $value . ';');
                if (array_key_exists($value, $this->arModifiedRelations)) {
                    if ((is_int($actualVal)) || ($actualVal == NULL)) {
                        $objStatement->bindValue(':' . $value, $actualVal, PDO::PARAM_INT);
                    } else {
                        $objStatement->bindValue(':' . $value, $actualVal, PDO::PARAM_STR);
                    }
                }
            }
            $objStatement->execute();
        } else {
            throw new Exception("Cannot update user without ID.");
        }
    }
}


?>
