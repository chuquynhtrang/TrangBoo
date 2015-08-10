<?php
require_once 'Database.php';
require_once 'Model.php';
class ProductModel extends Model {

    public function __construct($table)
    {
        parent::__construct($table);
    }

    public function query_select()
    {
        $query = "SELECT p.id,p.productname,c.categoryname,p.price, p.category_id,p.activate,p.time_created,p.time_updated  FROM products p JOIN categories c ON p.category_id = c.id";
        return $query;
    }

    public function query_where($column,$condition)
    {
        $query = "WHERE $column = '$condition'";
        return $query;
    }

    public function query_limit($offset,$step)
    {
        $query = "LIMIT $offset,$step";
        return $query;
    }

    public function query_sort($column,$order)
    {
        $query = "ORDER BY $column $order";
        return $query;
    }

    public function query_search($column,$search)
    {
        $query = "WHERE $column LIKE '%$search%'";
        return $query;
    }
    public function join()
    {
       $query = $this->query_select();
        $result = $this->cont->query($query);
        return $result;
    }
    public function filter($category_id)
    {
        $query = $this->query_select().' '.$this->query_where('p.category_id',$category_id);
        $result = $this->cont->query($query);
        return $result;
    }

    public function filter_search($category_id,$column,$search)
    {
        $query = $this->query_select().' '.$this->query_search($column,$search)." AND p.category_id = $category_id";
//        var_dump($query);
        $result = $this->cont->query($query);
//        var_dump($result);
        return $result;
    }

    public function filter_search_limit($category_id,$column,$search,$offset,$step)
    {
        $query = $this->query_select().' '.$this->query_search($column,$search)." AND p.category_id = $category_id".' '.$this->query_limit($offset,$step);
//        var_dump($query);
        $result = $this->cont->query($query);
//        var_dump($result);
        return $result;
    }
    public function filterLimit($category_id,$offset,$step)
    {
        $query = $this->query_select().' '.$this->query_where('p.category_id',$category_id).' '.$this->query_limit($offset,$step);
        $result = $this->cont->query($query);
        return $result;
    }
    public function joinLimit($offset,$step){
        $query = $this->query_select().' '.$this->query_limit($offset,$step);
        $result = $this->cont->query($query);
        return $result;
    }

    public function joinsort($column,$order,$offset,$step)
    {
        $query = $this->query_select().' '. $this->query_sort($column,$order).' '.$this->query_limit($offset,$step);
        $result = $this->cont->query($query);
        return $result;
    }

    public function joinsearch($column,$search)
    {
        $query = $this->query_select().' '.$this->query_search($column,$search);
        $result = $this->cont->query($query);
        return $result;
    }
    public function joinsearchLimit($column,$search,$offset,$step)
    {
        $query = $this->query_select().' '.$this->query_search($column,$search).' '.$this->query_limit($offset,$step);
        $result = $this->cont->query($query);
        return $result;
    }

    public function filter_sort($category_id,$column_sort,$order,$offset,$step)
    {
        $query = $this->query_select().' '.$this->query_where('p.category_id',$category_id).' '.$this->query_sort($column_sort,$order).' '.$this->query_limit($offset,$step);
        $result = $this->cont->query($query);
        return $result;
    }
}