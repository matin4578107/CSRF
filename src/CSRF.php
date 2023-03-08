<?php namespace src;
    session_start();
    class CSRF {
        
        public function searchForm(string $file_path) {
            $temp_file = fopen($file_path, "r");
  
            $file_text = '';
            while(!feof($temp_file)) {
        
                $temp_line = fgets($temp_file);
                $wite_space_before = str_contains($temp_line, "</form>") ? str_replace(preg_replace('/^\s+/', '', $temp_line), '', $temp_line) : '';
                $file_text .= str_contains($temp_line, "</form>") ? sprintf('%s%s<input type="text" name="CSRF" value="<?php echo($_SESSION["CSRF"]); ?>" hidden>%s', "\t", $wite_space_before, "\n") . $temp_line : $temp_line;
            }
            fclose($temp_file);

            $temp_file = fopen($file_path, "w");
            fwrite($temp_file, $file_text);
            fclose($temp_file);
        }

        public function generate(int $length = 32) {
            $_SESSION["CSRF"] = bin2hex(random_bytes($length));
        }

        public function setCSRF(string $form_path, string $checker_path = '') {
            if($checker_path == '') {$checker_path = $form_path;}
            $this->searchForm($form_path);
            $this->checker($checker_path);
            $this->removeSet($form_path);
        }

        public function checker(string $file_path) {
            $temp_file = fopen($file_path, "r");

            $flag_add_line = false;
            $file_text = '';
            while(!feof($temp_file)) {
                $temp_line = fgets($temp_file);
                if(str_contains($temp_line, "setCSRF")) {
                    $file_text .= $temp_line;
                    $flag_add_line = true;
                } else if ($flag_add_line) {
                    $file_text .= '    if(isset($_POST["CSRF"]) && $_POST["CSRF"] == $_SESSION["CSRF"]) {echo("Token valid"); /*Write here*/}';
                    $file_text .= $temp_line;
                    $flag_add_line = false;
                } else {
                    $file_text .= $temp_line;
                }
            }
            file_put_contents($file_path, $file_text);
        }

        public function removeSet(string $file_path) {
            $temp_file = fopen($file_path, "r");
  
            $file_text = '';
            while(!feof($temp_file)) {
        
                $temp_line = fgets($temp_file);
                $file_text .= str_contains($temp_line, "setCSRF") ? '// ' . $temp_line : $temp_line;
            }
            file_put_contents($file_path, $file_text);
        }
    }

?>