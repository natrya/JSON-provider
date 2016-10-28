<?php
class konfig
{
	public 	$alamat='localhost',
		$nama='YOURUSERNAME',
		$panggilan='YOURPASSWORD',
        $rumah='training';
	public function ambilAlamat()
	{
		return $this->alamat;
	}
	public function ambilNama()
	{
		return $this->nama;
	}
	public function ambilPanggilan()
	{
		return $this->panggilan;
	}
	public function ambilRumah()
	{
		return $this->rumah;
	}
        public function charonly($input){
            $balik=preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $input);
            return $balik;
        }
}
?>
