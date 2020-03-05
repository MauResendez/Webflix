<?php
    class FormSanitizer
    {
        public static function sanitizeFormString($inputText)
        {
            $inputText = strip_tags($inputText); // Removes HTML tags
            $inputText = trim($inputText); // Removes spaces before and after the string
            $inputText = strtolower($inputText); // Lowercases string    
            $inputText = preg_replace("#[\s]+#", " ", $inputText);

            $words = explode(" ", $inputText);
            $string = "";
    
            for ($x = 0; $x < sizeof($words); $x++) // 
            {
                if($x == 0)
                {
                    $string = ucfirst($words[$x]); // creates name string
                }
                else
                {
                    $string = $string . " " . ucfirst($words[$x]); // adds a space with the next capitalized name to that name string
                }
            }
    
            return $string;
        }

        public static function sanitizeFormUsername($inputText)
        {
            $inputText = strip_tags($inputText); // Removes HTML tags
            $inputText = str_replace(" ", "", $inputText); // Removes spaces before and after the string
            return $inputText;
        }

        public static function sanitizeFormPassword($inputText)
        {
            $inputText = strip_tags($inputText); // Removes HTML tags
            return $inputText;
        }

        public static function sanitizeFormEmail($inputText)
        {
            $inputText = strip_tags($inputText); // Removes HTML tags
            $inputText = str_replace(" ", "", $inputText); // Removes spaces before and after the string
            return $inputText;
        }

        
    }
?>