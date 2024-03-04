<?php

class Filmcategory extends DataBoundObject {

    protected $ID;
    protected $CategoryID;
    protected $LastUpdate;

    protected function DefineTableName() {
        return("filmcategory");
    }

    protected function DefineRelationMap() {
        return(array(
            "id" => "ID",
            "category_id" => "CategoryID",
            "last_update" => "LastUpdate"
        ));
    }
}

?>