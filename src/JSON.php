<?php

namespace Smark\Smark;

class JSON
{
    public static function jsonRead($json_filename){
        if(file_exists($json_filename)){
            $check_if_the_file_extension_is_json = explode('.', $json_filename);
            $end_of_the_exploded_json_file = strtolower(end($check_if_the_file_extension_is_json));
            if($end_of_the_exploded_json_file != 'json'){ // IF FILE EXTENSION IS NOT JSON
                self::handleError("File extension error. It must be a .json file.");
                // echo "File extension error. It must be a .json file.";
            } else {
                return json_decode(file_get_contents($json_filename), true);
            }
        } else {
            self::handleError("The file you are attempting to access either does not exist in the specified directory, or there has been an error related to the filename extension, preventing the system from recognizing the file type and subsequently accessing its contents.");
            // echo "File doesn't exists or filename extension error";
        }
    }

    public static function jsonPush($json_filename, $data_to_be_inserted){
        if(file_exists($json_filename)){ // IF JSON FILE ALREADY EXIST
            $check_if_the_file_extension_is_json = explode('.', $json_filename);
            $end_of_the_exploded_json_file = strtolower(end($check_if_the_file_extension_is_json));
            if($end_of_the_exploded_json_file != 'json'){ // IF FILE EXTENSION IS NOT JSON
                self::handleError("File extension error. It must be a .json file.");
            } else {
                if(empty(file_get_contents($json_filename))){ // IF THE CONTENT OF JSON FILE IS EMPTY
                    file_put_contents($json_filename, '[]');
                    $json_file_decoded = json_decode(file_get_contents($json_filename), true);
                    // INSERTION
                    array_push($json_file_decoded, $data_to_be_inserted);
                    $json_file_encoded = json_encode($json_file_decoded, JSON_PRETTY_PRINT);
                    return file_put_contents($json_filename, $json_file_encoded);
                } else {
                    $json_file_decoded = json_decode(file_get_contents($json_filename), true);
                    // INSERTION
                    array_push($json_file_decoded, $data_to_be_inserted);
                    $json_file_encoded = json_encode($json_file_decoded, JSON_PRETTY_PRINT);
                    return file_put_contents($json_filename, $json_file_encoded);
                }
            }
        } else {
            $check_if_the_file_extension_is_json = explode('.', $json_filename);
            $end_of_the_exploded_json_file = strtolower(end($check_if_the_file_extension_is_json));
            if($end_of_the_exploded_json_file != 'json'){
                self::handleError("File extension error. It must be a .json file.");
            } else {
                file_put_contents($json_filename, '[]');
                $json_file_decoded = json_decode(file_get_contents($json_filename), true);
                // INSERTION
                array_push($json_file_decoded, $data_to_be_inserted);
                $json_file_encoded = json_encode($json_file_decoded, JSON_PRETTY_PRINT);
                return file_put_contents($json_filename, $json_file_encoded);
            }
        }
    }

    public static function jsonUnshift($json_filename, $data_to_be_inserted){
        if(file_exists($json_filename)){ // IF JSON FILE ALREADY EXIST
            $check_if_the_file_extension_is_json = explode('.', $json_filename);
            $end_of_the_exploded_json_file = strtolower(end($check_if_the_file_extension_is_json));
            if($end_of_the_exploded_json_file != 'json'){ // IF FILE EXTENSION IS NOT JSON
                self::handleError("File extension error. It must be a .json file.");
            } else {
                if(empty(file_get_contents($json_filename))){ // IF THE CONTENT OF JSON FILE IS EMPTY
                    file_put_contents($json_filename, '[]');
                    $json_file_decoded = json_decode(file_get_contents($json_filename), true);
                    // INSERTION
                    array_unshift($json_file_decoded, $data_to_be_inserted);
                    $json_file_encoded = json_encode($json_file_decoded, JSON_PRETTY_PRINT);
                    return file_put_contents($json_filename, $json_file_encoded);
                } else {
                    $json_file_decoded = json_decode(file_get_contents($json_filename), true);
                    // INSERTION
                    array_unshift($json_file_decoded, $data_to_be_inserted);
                    $json_file_encoded = json_encode($json_file_decoded, JSON_PRETTY_PRINT);
                    return file_put_contents($json_filename, $json_file_encoded);
                }
            }
        } else {
            $check_if_the_file_extension_is_json = explode('.', $json_filename);
            $end_of_the_exploded_json_file = strtolower(end($check_if_the_file_extension_is_json));
            if($end_of_the_exploded_json_file != 'json'){
                self::handleError("File extension error. It must be a .json file.");
            } else {
                file_put_contents($json_filename, '[]');
                $json_file_decoded = json_decode(file_get_contents($json_filename), true);
                // INSERTION
                array_unshift($json_file_decoded, $data_to_be_inserted);
                $json_file_encoded = json_encode($json_file_decoded, JSON_PRETTY_PRINT);
                return file_put_contents($json_filename, $json_file_encoded);
            }
        }
    }

    public static function jsonDelete($json_filename, $data_key_to_be_deleted, $data_value_to_be_deleted){
        if(file_exists($json_filename)){
            $check_if_the_file_extension_is_json = explode('.', $json_filename);
            $end_of_the_exploded_json_file = strtolower(end($check_if_the_file_extension_is_json));
            if($end_of_the_exploded_json_file != 'json'){ // IF FILE EXTENSION IS NOT JSON
                self::handleError("File extension error. It must be a .json file.");
            } else {
                $json_file_decoded = json_decode(file_get_contents($json_filename), true);
                foreach ($json_file_decoded as $key => $value) {
                    if($value[$data_key_to_be_deleted] === $data_value_to_be_deleted){
                        // DELETION
                        array_splice($json_file_decoded, $key, 1);
                        $json_file_encoded = json_encode($json_file_decoded, JSON_PRETTY_PRINT);
                        return file_put_contents($json_filename, $json_file_encoded);
                    }
                }
            }
        } else {
            self::handleError("The file you are attempting to access either does not exist in the specified directory, or there has been an error related to the filename extension, preventing the system from recognizing the file type and subsequently accessing its contents.");
        }
    }

    public static function jsonUpdate($json_filename, $data_key_to_be_updated, $data_value_to_be_updated, $key_to_insert_new_updated_data, $new_updated_data){
        if(file_exists($json_filename)){
            $check_if_the_file_extension_is_json = explode('.', $json_filename);
            $end_of_the_exploded_json_file = strtolower(end($check_if_the_file_extension_is_json));
            if($end_of_the_exploded_json_file != 'json'){ // IF FILE EXTENSION IS NOT JSON
                self::handleError("File extension error. It must be a .json file.");
            } else {
                $json_file_decoded = json_decode(file_get_contents($json_filename), true);
                foreach ($json_file_decoded as $key => $value) {
                    if($value[$data_key_to_be_updated] === $data_value_to_be_updated){
                        // UPDATION
                        $json_file_decoded[$key][$key_to_insert_new_updated_data] = $new_updated_data;
                        $json_file_encoded = json_encode($json_file_decoded, JSON_PRETTY_PRINT);
                        return file_put_contents($json_filename, $json_file_encoded);
                    }
                }
            }
        } else {
            self::handleError("The file you are attempting to access either does not exist in the specified directory, or there has been an error related to the filename extension, preventing the system from recognizing the file type and subsequently accessing its contents.");
        }
    }

    private static function handleError($message) {
        echo <<<HTML
        <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Error</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f8d7da;
                        color: #721c24;
                        padding: 20px;
                        border: 1px solid #f5c6cb;
                        border-radius: 5px;
                    }
                    h1 {
                        color: #c7254e;
                    }
                </style>
            </head>
                <body>
                    <h1>Error</h1>
                    <p>$message</p>
                </body>
            </html>
        HTML;
        exit; // Stop execution after displaying the error
    }
}
