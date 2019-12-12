<?php

namespace App\DB;

use App\DB;
use Symfony\Component\HttpFoundation\ParameterBag;

class TableRow {
    protected $table;
    public $id;
    public $data;

    protected $primaryKey = 'id';
    

    public function __construct($table, $id=0, $data=[]) {
        $this->table = $table;
        $this->data = new ParameterBag($data);
    }

    public function exists() {
        return count(DB::query()
            ->select($this->primaryKey)
            ->table($this->table)
            ->where($this->primaryKey, $this->id)
            ->get()) > 0;
    }

    public function save() {
        if(!$this->exists()) {
            $this->insert($this->data->parameters);
        } else {
            $this->update($this->data->parameters);
        }

        return $this;
    }

    public function update($data) {
        if($this->exists()) {
            DB::query()
            ->table($this->table)
            ->set($data)
            ->where($this->primaryKey, $this->id)
            ->execute();
            
        }
        return $this;
    }

    public function insert($data) {
        DB::query()
        ->table($this->table)
        ->insert($data)
        ->execute();

        

        return DB::$db ? intval(DB::$db->lastInsertId()) : null;
    }

    public function get($columns=null, $callback=null) {
        $q = $this->select($columns);

        if(is_callable($callback)) {
            $callback($q);
        }

        return collect($q->get())->first();
    }

    public function select($columns=null) {
        return DB::query()
        ->select($columns)
        ->table($this->table)
        ->where($this->primaryKey, $this->id);
    }

    public function delete($callback=null) {
        $q = DB::query()
        ->table($this->table)
        ->delete()
        ->where($this->primaryKey, $this->id);
        if(is_callable($callback)) {
            $callback($q);
        }

        return $q->execute();
    }

    public function load() {
        $this->data->add($this->get());
        return $this;
    }
}