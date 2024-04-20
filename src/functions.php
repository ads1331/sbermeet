<?php
// подключение к базе
    function connect(){
        $driver = apache_getenv('driver');
        $host = apache_getenv('host');
        $db_name = apache_getenv('db_name');
        $db_user = apache_getenv('db_user');
        $db_password = apache_getenv('db_password');
        $charset = apache_getenv('charset');

        try{
            return new PDO("$driver:host=$host;dbname=$db_name;charset=$charset", $db_user, $db_password);
        }catch(PDOException $e){
            die('Нет подключения к базе данных. Ошибка - ' . $e->getMessage());
        }
    }

    //функция для запросов поиска (SELECT)
    function query($sql, $params = []){
        $sth = connect();
        $sth = $sth->prepare($sql); //Подготавливает запрос к выполнению и возвращает связанный с этим запросом объект
        $sth->execute($params); //Запускает подготовленный запрос на выполнение
        $result = $sth->fetchAll(PDO::FETCH_ASSOC); //Возвращает массив, содержащий все строки результирующего набора

        if (!$result) return [];
        return $result;
    }

    //метод для добавления, удаления, изменения данных, если успешно то возвратит 1
    //INSERT, UPDATE, DELETE
    function make($sql, $params = []){
        $sth = connect();
        $sth = $sth->prepare($sql); //Подготавливает запрос к выполнению и возвращает связанный с этим запросом объект
        return $sth->execute($params); //Запускает подготовленный запрос на выполнение
    }

    // валидация полей с html-форм
    function validate($data) {
    	$data = strip_tags($data);
        $data = trim($data);
        $data = preg_replace('/\s+/', ' ', $data);
        // $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }