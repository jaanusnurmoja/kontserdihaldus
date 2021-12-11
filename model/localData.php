<?php 
    class LocalData 
    {
        private $table = '';
        private $fields = [];
        private $id = null;   
        private $data;

        function __construct($data = null)
        {
            $this->data = $data;
        }
    
    

        /**
         * Get the value of table
         */
        public function getTable()
        {
                    return $this->table;
        }

        /**
         * Set the value of table
         *
         * @return  self
         */
        public function setTable($table)
        {
                    $this->table = $table;

                    return $this;
        }

        /**
         * Get the value of fields
         */
        public function getFields()
        {
                    return $this->fields;
        }

        /**
         * Set the value of fields
         *
         * @return  self
         */
        public function setFields($fields)
        {
                    $this->fields = $fields;

                    return $this;
        }

        /**
         * Get the value of id
         */
        public function getId()
        {
                    return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */
        public function setId($id)
        {
                    $this->id = $id;

                    return $this;
        }

        /**
         * Get the value of data
         */
        public function getData()
        {
                    return $this->data;
        }

        /**
         * Set the value of data
         *
         * @return  self
         */
        public function setData($data)
        {
                    $this->data = $data;

                    return $this;
        }
}