<?php

class Category extends DataBoundObject {

    protected $ID;
    protected $Name;
    protected $LastUpdate;

    protected function DefineTableName() {
        return("category");
    }

    protected function DefineRelationMap() {
        return(array(
            "id" => "ID",
            "name" => "Name",
            "last_update" => "LastUpdate"
        ));
    }
}

?>