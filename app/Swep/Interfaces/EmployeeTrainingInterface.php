<?php

namespace App\Swep\Interfaces;
 


interface EmployeeTrainingInterface {

	public function getByEmpNo($slug);

	public function store($request, $slug);
	
	public function update($request, $emp_slug, $emp_trng_slug);
	
	public function destroy($slug);

	public function getBySlug($slug);

}