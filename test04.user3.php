<?php

require("class.pdofactory.php");
require("class.user3.php");
require("class.film.php");
require("class.filmcategory.php");
require("class.category.php");
require("abstract.databoundobject.php");

print "Running...<br />";

try {
    // Establecer la conexión PDO
    $strDSN = "pgsql:dbname=usuaris;host=localhost;port=5432";
    $objPDO = PDOFactory::GetPDO($strDSN, "postgres", "root", array());
    $objPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Crear instancia de User
    $objUser = new User($objPDO);
	
    $objFilm = new Film($objPDO);
    $objCategory = new Category($objPDO);
    $objFilmcategory = new Filmcategory($objPDO);


    // Establecer atributos del usuario
    $objUser->setFirstName("Steve");
    $objUser->setLastName("Nowicki");
    $objUser->setDateAccountCreated(date("Y-m-d"));

    // Mostrar información del usuario antes de guardar
    print "First name is " . $objUser->getFirstName() . "<br />";
    print "Last name is " . $objUser->getLastName() . "<br />";

    // Guardar usuario en la base de datos
    print "Creating user...<br />";
    $objUser->Save();

    // Obtener ID del usuario creado
    $id = $objUser->getID();
    print "ID in database is " . $id . "<br />";

    // Destruir objeto usuario
    print "Destroying object...<br />";
    unset($objUser);

    // Recrear objeto usuario desde el ID
    print "Recreating object from ID $id<br />";
    $objUser = new User($objPDO, $id);

    // Mostrar información del usuario después de recrear
    print "First name after recreation is " . $objUser->getFirstName() . "<br />";
    print "Last name after recreation is " . $objUser->getLastName() . "<br />";

    // Actualizar usuario
    print "Updating user...<br />";
    $objUser->setFirstName("John");
    $objUser->setLastName("Doe");
    $objUser->Update();

    // Mostrar información del usuario después de actualizar
    print "First name after update is " . $objUser->getFirstName() . "<br />";
    print "Last name after update is " . $objUser->getLastName() . "<br />";

} catch (PDOException $e) {
    // Capturar y mostrar cualquier excepción PDO
    echo "PDO Exception: " . $e->getMessage();
}
?>


