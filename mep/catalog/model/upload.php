<?php 
	class UploadModel extends db {
		public function getFile($filename) {
			$this->where('id_company', id_company());
			$this->where('image', $filename);
			$result = $this->get('file');
			return $result->row;
		}
		public function addFile($data=array()) {
			return $this->insert('file', $data);
		}
		public function editFile($data=array(),$id) {
			return $this->update('file',$data,'id_file='.(int)$id);
		}
		public function deleteFile($id) {
			return $this->delete('file','id_file='.(int)$id);
		}
	}
?>