<?php

require_once "koneksi.php";

if(function_exists($_GET['function'])){
    $_GET['function']();
}
    function getNajla(){

        global $koneksi;
        $query=mysqli_query($koneksi, "SELECT * FROM najla");
        while($data= mysqli_fetch_object($query)){
            $najla[]= $data;

        }
   $respon=array(
    'status' =>1,
    'message' => 'success get najla',
    'najla' => $najla
   );
   
  header('content-type: application/json');
   print json_encode($respon);
   
    }


    function addNajla(){

        global $koneksi;
        $parameter =array(
            'nama'=> '',
            'alamat' => ''
        );
        $cekData = count(array_intersect_key($_POST, $parameter));
        if($cekData == count($parameter)){
            $nama = $_POST['nama'];
            $alamat = $_POST['alamat'];

            $result= mysqli_query($koneksi, "INSERT INTO najla VALUE('', '$nama', '$alamat')");

            if($result){
                return message(1,"insert data $nama sukses");
                
            }else{
                return message(0, "insert data gagal");

            }
        }else{
            return message(0, "parameter gagalll");
        }
    }
        function message ($status, $msg){
            $respon =array(
                'status' => $status,
                'message' => $msg
            );
        
        
        header('content-type: application/json');
        print json_encode($respon); 
        }
    

        function updateNajla(){

            global $koneksi;

            if(!empty($_GET['id'])){
                $id=$_GET['id'];
            }

            $parameter = array(
                'nama' =>"",
                'alamat' => ""
            
            );


          $cekData = count(array_intersect_key($_POST, $parameter));

            if($cekData == count($parameter)){
                $nama = $_POST['nama'];
                $alamat = $_POST['alamat'];

                $result= mysqli_query($koneksi, "UPDATE najla SET nama='$nama', alamat='$alamat' WHERE id='$id' "); 

                if($result){
                    return message(1,"edit  data $nama sukses");
                    
                }else{
                    return message(0, "edit data gagal");
    
                }
            }else{
                return message(0, "parameter gagalllllll");
            }
        }

        function deleteNajla(){
            global $koneksi;

            if(!empty($_GET['id'])){
                $id=$_GET['id'];
            }

            $result= mysqli_query($koneksi, "DELETE FROM najla WHERE id='$id' ");

            if($result){
                return message(1,"delete sukses");
                
            }else{
                return message(0, "delete gagal");

            }


        }


?>