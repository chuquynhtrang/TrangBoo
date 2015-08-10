<?php
session_start();
class BaseController{
    public function view($name,$data=array()){
        extract($data);
        return require_once ('View/'.$name.'.php');
    }

    public function indexBase($table,$model,$column_search,$href)
    {
        $md = new $model($table);
        $page = $_GET['page'];
        if(isset($_GET['search'])){
            $search = $_GET['search'];
            $dt = $md->search($column_search,$search);
            $total_record = $dt->num_rows;
            $pagination = new Pagination($total_record, NUMBER_RECORD, $page);
            $data['link'] = $pagination->paginationPanel($href);
            $offset = $pagination->getOffset();
            if(isset($_GET['sort'])){
                $sort = $_GET['sort'];
                $order = $_GET['order'];
                $data['data_limit'] = $md->sortBySearch($search,$column_search,$sort,$order,$offset,NUMBER_RECORD);
                return $data;
            }
            $data['data_limit'] = $md->searchLimit($column_search,$search,$offset,NUMBER_RECORD);
            return $data;
        } else if(isset($_GET['sort'])&& empty($_GET['search'])){
            $sort = $_GET['sort'];
            $order = $_GET['order'];
            $dt = $md->getAll('*');
            $totalRecord = $dt->num_rows;
            $pagination = new Pagination($totalRecord,NUMBER_RECORD,$page);
            $data['link'] = $pagination->paginationPanel($href);
            $offset = $pagination->getOffset();
            $data['data_limit'] = $md->sortBy($sort,$order, $offset, NUMBER_RECORD);
            return $data;
        }
        else {
            if(isset($_POST['activate']) || isset($_POST['delete'])){
                $this->handleBase($table,$model);
            }
            $dt = $md->getAll('*');
            $total_record = $dt->num_rows;
            $pagination = new Pagination($total_record, NUMBER_RECORD, $page);
            $data['link'] = $pagination->paginationPanel($href);
            $offset = $pagination->getOffset();
            $data['data_limit'] = $md->getAllLimit($offset, NUMBER_RECORD);
            return $data;
        }
    }

    public function add($table,$model,$post=array())
    {
        $md = new $model($table);
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (isset($_POST['create'])) {
                $array = array_values($post);
                $file_path = 'upload/'.$array[0];
                if (isset($_FILES['avatar'])) {
                    move_uploaded_file($_FILES['avatar']['tmp_name'], $file_path.'.jpg');
                }
//                var_dump($post);
                var_dump(array_values($post));
                $md->insert($post);
                var_dump($md->insert($post));
            }
        }
    }
    public function handleBase($table,$model)
    {
        $md = new $model($table);
        $id = $_POST['checkbox'];
        if (isset($_POST['delete'])) {
            foreach ($id as $i) {
                $result = $md->getBy('*','id',$i);
                $row = $result->fetch_assoc();
                if($table=='products')
                    $name = $row['productname'];
                else
                    $name = $row['username'];
                if($table=='products' || $table=='users')
                    unlink('upload/'.$name.'.jpg');
                $md->delete($i);
            }
        } else
            if (isset($_POST['activate'])) {
                foreach ($id as $i) {
                    $md->activate($i);
                }
            }
    }

    public function getOldEdit($table,$model)
    {
        $md = new $model($table);
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $result = $md->getBy('*','id',$id);
            $data = $result->fetch_assoc();
        }
        return $data;
    }

    public function edit($table,$model,$post=array())
    {
        $md = new $model($table);
        $id = $_GET['id'];
        $result = $md->getBy('*','id',$id);
        $row = $result->fetch_assoc();
        $a = array_values($row);
        $name = $a[1];
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if(isset($_POST['update'])) {
                $array = array_values($post);
                $file_path = 'upload/'.$array[0].'.jpg';
                $file_path1 = 'upload/' . $name . '.jpg';
                if($_FILES['avatar']['name']){
                    if(file_exists($file_path1)){
                        unlink($file_path1);
                    }
                    move_uploaded_file($_FILES['avatar']['tmp_name'],$file_path);
                } else
                    rename($file_path1,$file_path);
                if($_SESSION['username'] == $name)
                $_SESSION['username'] = $array[0];
                $md->update($id, $post);
            }
        }
    }
}