<?php
include 'gembok.php';
class QueryKontak
{
    private $_db;
    protected $_result;
    public $results;
    public function __construct()
    {
        $gembok= new konfig();
        $_db = new mysqli($gembok->ambilAlamat(), $gembok->ambilNama() ,$gembok->ambilPanggilan(), $gembok->ambilRumah());
        if ($_db->connect_error) {
            die('Connection Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
        }
        return $_db;
    }
     /**
     * @api {post} /router.php Ambil kontak
     * @apiName  getResults
     * @apiGroup Kontak
     * @apiVersion 1.0.0
     *
     * @apiParam {String} action QueryKontak
     * @apiParam {String} method getResults
     * @apiParam {Object} data
     * @apiParam {Number} data.start mulai dari 0
     * @apiParam {Number} data.limit limit jumlah record
     *
     * @apiParamExample {json} Request-Example:
     * {
     *  "action":"QueryKontak",
     *  "method":"getResults",
     *  "data":[{
     *      "start":"0",
     *      "limit":"10"
     *  }]
     * }
     * @apiSuccess {String} success 1
     *
     * @apiSuccessExample {json} Success-Response:
     * {
     *  "action":"QueryKontak",
     *  "method":"getResults",
     *  "result":{
     *      "success":1,
     *      "totalCount":"1",
     *      "hasil":[{
     *          "idkontak":1,
     *          "nama":"Ryan Fabella",
     *          "email":"ryanthe@gmail.com",
     *          "notelp":"0817309405",
     *          "alamat":"rungkut surabaya",
     *          "foto":"http://127.0.0.1/training/foto/ryan.jpg"
     *      }]
     *  }
     * }
     */
    public function getResults(stdClass $params)
    {
        //ini_set("display_errors", "1");
        //error_reporting(E_ALL);
        $_db = $this->__construct();
        $results = array();
        $hasil= array();
        $mulai=(int)$params->start;
        $banyak=(int)$params->limit;
        $query = "SELECT count(idkontak) as total FROM kontak;";
        if($stmt = $_db->prepare($query)) {
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $results['totalCount'] = $row['total'];
            }
            $stmt->free_result();
            $query = "SELECT idkontak,nama,email,notelp,alamat,CONCAT('http://192.168.1.9/training/foto/',foto) as foto from kontak  ORDER BY idkontak DESC LIMIT ?,?";
            if($stmt = $_db->prepare($query)) {
                $stmt->bind_param('ii',$mulai,$banyak);
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    $hasil[] = $row;
                }
                $stmt->free_result();
                $results['success']=1;
            }else{
                $results['success']=0;
            }
        }
        $stmt->close();
        $results['hasil']=$hasil;
        return $results;
    }
    /**
     * @api {post} /router.php Buat kontak
     * @apiName  createRecord
     * @apiGroup Kontak
     * @apiVersion 1.0.0
     *
     * @apiParam {String} action QueryKontak
     * @apiParam {String} method createRecord
     * @apiParam {Object} data
     * @apiParam {String} data.nama nama
     * @apiParam {String} data.email email
     * @apiParam {String} data.notelp No Telp/HP
     * @apiParam {String} data.alamat Alamat
     * @apiParam {String} data.foto foto
     *
     * @apiParamExample {json} Request-Example:
     * {
     *  "action":"QueryKontak",
     *  "method":"createRecord",
     *  "data":[{
     *      "nama":"Ryan Fabella",
     *      "email":"ryanthe@gmail.com",
     *      "notelp":"0817309405",
     *      "alamat":"rungkut surabaya",
     *      "foto":"ryan.jpg"
     *  }]
     * }
     * @apiSuccess {String} success 1
     * @apiSuccess {Number} idkontak
     *
     * @apiSuccessExample {json} Success-Response:
     * {
     *  "action":"QueryKontak",
     *  "method":"createRecord",
     *  "result":{
     *      "nama":"Ryan Fabella",
     *      "email":"ryanthe@gmail.com",
     *      "notelp":"0817309405",
     *      "alamat":"rungkut surabaya",
     *      "foto":"ryan.jpg",
     *      "idkontak":0,
     *      "success":1
     *  }
     * }
     */
    public function createRecord(stdClass $params)
    {
        $_db = $this->__construct();
        $query= "INSERT INTO kontak(nama,email,notelp,alamat,foto) VALUES (?,?,?,?,?)";
        if($stmt = $_db->prepare($query)) {
            $stmt->bind_param('sssss', $nama,$email,$notelp,$alamat,$foto);
            $nama=$params->nama;
            $email=$params->email;
            $notelp=$params->notelp;
            $alamat=$params->alamat;
            $foto=$params->foto;
            $stmt->execute();
            $params->idkontak = $stmt->insert_id;
            $params->success=1;
            if(isset($_FILES)){
                $temp_file = $_FILES['namafoto']['tmp_name'];
                if (move_uploaded_file($temp_file, '/var/www/training/foto/'.$params->foto)) {
                    $params->msgfilektp='';
                } else {
                    $params->msgfilektp='gagal menulis file';
                }
            }
        }else{
            $params->debug=$stmt->error;
            $params->success=0;
            $params->msg="failed to save kontak";
        }
        $stmt->close();
        return $params;
    }
    /**
     * @api {post} /router.php update kontak
     * @apiName  updateRecord
     * @apiGroup Kontak
     * @apiVersion 1.0.0
     *
     * @apiParam {String} action QueryKontak
     * @apiParam {String} method updateRecord
     * @apiParam {Object} data
     * @apiParam {Number} data.idkontak id
     * @apiParam {String} data.nama nama
     * @apiParam {String} data.email email
     * @apiParam {String} data.notelp No Telp/HP
     * @apiParam {String} data.alamat Alamat
     * @apiParam {String} data.foto foto
     *
     * @apiParamExample {json} Request-Example:
     * {
     *  "action":"QueryKontak",
     *  "method":"updateRecord",
     *  "data":[{
     *      "idkontak":"1",
     *      "nama":"Ryan Fabella",
     *      "email":"ryanthe@gmail.com",
     *      "notelp":"081357966316",
     *      "alamat":"surabaya",
     *      "foto":"ryan.jpg"
     *  }]
     * }
     * @apiSuccess {String} success 1
     *
     * @apiSuccessExample {json} Success-Response:
     * {
     *  "action":"QueryKontak",
     *  "method":"updateRecord",
     *  "result":{
     *      "idkontak":"1",
     *      "nama":"Ryan Fabella",
     *      "email":"ryanthe@gmail.com",
     *      "notelp":"081357966316",
     *      "alamat":"surabaya",
     *      "foto":"ryan.jpg",
     *      "success":1
     *  }
     * }
     */
     public function updateRecord(stdClass $params)
    {
        $_db = $this->__construct();
        $query= "update kontak set nama=?,email=?,notelp=?,alamat=?,foto=? where idkontak=?";
        if($stmt = $_db->prepare($query)) {
            $stmt->bind_param('sssssi', $nama,$email,$notelp,$alamat,$foto,$idkontak);
            $nama=$params->nama;
            $email=$params->email;
            $notelp=$params->notelp;
            $alamat=$params->alamat;
            $foto=$params->foto;
            $idkontak=(int)$params->idkontak;
            $stmt->execute();
            if ($stmt->error){
                $params->debug=$stmt->error;
                $params->success=0;
                $params->msg="failed to save kontak";
            }else{
                if(isset($_FILES)){
                $temp_file = $_FILES['namafoto']['tmp_name'];
                if (move_uploaded_file($temp_file, '/var/www/training/foto/'.$params->foto)) {
                    $params->msgfilektp='';
                } else {
                    $params->msgfilektp='gagal menulis file';
                }
            }
                $params->success=1;
            }
        }else{
            $params->debug=$stmt->error;
            $params->success=0;
            $params->msg="failed to save kontak";
        }
        $stmt->close();
        return $params;
    }
    /**
     * @api {post} /router.php delete kontak
     * @apiName  deleteRecord
     * @apiGroup Kontak
     * @apiVersion 1.0.0
     *
     * @apiParam {String} action QueryKontak
     * @apiParam {String} method deleteRecord
     * @apiParam {Object} data
     * @apiParam {Number} data.idkontak id
     *
     * @apiParamExample {json} Request-Example:
     * {
     *  "action":"QueryKontak",
     *  "method":"deleteRecord",
     *  "data":[{
     *      "idkontak":"1"
     *  }]
     * }
     * @apiSuccess {String} success 1
     *
     * @apiSuccessExample {json} Success-Response:
     * {
     *  "action":"QueryExperience",
     *  "method":"deleteRecord",
     *  "result":{
     *      "idkontak":"1",
     *      "success":1
     *  }
     * }
     */
      public function deleteRecord(stdClass $params)
    {
        $_db = $this->__construct();
        $query= "delete from kontak where idkontak=?";
        if($stmt = $_db->prepare($query)) {
            $stmt->bind_param('i', $idkontak);
            $idkontak=(int)$params->idkontak;
            $stmt->execute();
            if ($stmt->error){
                $params->debug=$stmt->error;
                $params->success=0;
                $params->msg="failed to delete kontak";
            }else{
                $params->success=1;
            }
        }else{
            $params->debug=$stmt->error;
            $params->success=0;
            $params->msg="failed to delete kontak";
        }
        $stmt->close();
        return $params;
    }
    public function __destruct()
    {
        $_db = $this->__construct();
        $_db->close();
        unset($_result);
        unset($results);
        return $this;
    }
}

?>
