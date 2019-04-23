<?php

abstract class View
{
 
    // It loads the object with the model.
    public function loadModel($name, $path='model/') 
    {
        $path=$path.$name.'.php';
        $name=$name.'Model';
        try 
        {
            if(is_file($path)) 
            {
                require $path;
                $ob=new $name();
            } 
            else 
            {
                throw new Exception('Can not open model '.$name.' in: '.$path);
            }
        }
        catch(Exception $e) 
        {
            echo $e->getMessage().'<br />
                File: '.$e->getFile().'<br />
                Code line: '.$e->getLine().'<br />
                Trace: '.$e->getTraceAsString();
            exit;
        }
        return $ob;
    }

    // It includes template file.
    public function render($name, $path='templates/') 
    {
        $path=$path.$name.'.html.php';
        try 
        {
            if(is_file($path)) 
            {
                require $path;
            } 
            else 
            {
                throw new Exception('Can not open template '.$name.' in: '.$path);
            }
        }
        catch(Exception $e) 
        {
            echo $e->getMessage().'<br />
                File: '.$e->getFile().'<br />
                Code line: '.$e->getLine().'<br />
                Trace: '.$e->getTraceAsString();
            exit;
        }
    }

    // It sets data.
    public function set($name, $value) 
    {
        $this->$name=$value;
    }
    
    // It gets data.
    public function get($name) 
    {
        return $this->$name;
    }
}