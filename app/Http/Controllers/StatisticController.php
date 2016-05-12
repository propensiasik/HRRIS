<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;  
use Session;
use Auth;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Khill\Lavacharts\Lavacharts;

use App\Applicant;
use App\Jobvacant;

use App\Http\Controllers\Controller;

use DB;

class StatisticController extends Controller
{

    public function statistic (){

        //METHOD INI DIGUNAKAN UNTUK MENAMPILKAN DATA STATISTIK YANG BERUPA CHART PADA HALAMAN STATISTIK DENGAN MENGGUNAKAN LAVACHARTS.


        //FEMALE DAN MALE DIGUNAKAN UNTUK MENGHITUNG DATA FEMALE DAN MALE DARI APPLICANT YANG MENDAFTAR
        $female = DB::table('applicant')
                        ->select(DB::raw('count(*) as female, gender'))
                        ->where('gender', '=', 'F')
                        ->groupBy('gender')
                        ->first();


        $male = DB::table('applicant')
                        ->select(DB::raw('count(*) as male, gender'))
                        ->where('gender', '=', 'M')
                        ->groupBy('gender')
                        ->first();

        
        //DIBAWAH INI UNTUK MENGHITUNG JUMLAH PENDAFTAR MASING-MASING ORGANISASI

        $definite = DB::table('applicant')
                        ->select(DB::raw('count(*) as definite, nama_company'))
                        ->join('job_vacant', 'applicant.id_job_vacant' , '=' , 'job_vacant.id_job_vacant')
                        ->join('divisi', 'job_vacant.id_divisi', '=', 'divisi.id_divisi')
                        ->join('company', 'divisi.id_company', '=', 'company.id_company')
                        ->where('nama_company' , '=' , 'Definite (PT Definite Maji Arsana)')
                        ->groupBy('nama_company')
                        ->first();


        $flipbox = DB::table('applicant')
                        ->select(DB::raw('count(*) as flipbox, nama_company'))
                        ->join('job_vacant', 'applicant.id_job_vacant' , '=' , 'job_vacant.id_job_vacant')
                        ->join('divisi', 'job_vacant.id_divisi', '=', 'divisi.id_divisi')
                        ->join('company', 'divisi.id_company', '=', 'company.id_company')
                        ->where('nama_company' , '=' , 'Flipbox (PT Saka Digital Arsana)')
                        ->groupBy('nama_company')
                        ->first();

        $innovecto = DB::table('applicant')
                        ->select(DB::raw('count(*) as innovecto, nama_company'))
                        ->join('job_vacant', 'applicant.id_job_vacant' , '=' , 'job_vacant.id_job_vacant')
                        ->join('divisi', 'job_vacant.id_divisi', '=', 'divisi.id_divisi')
                        ->join('company', 'divisi.id_company', '=', 'company.id_company')
                        ->where('nama_company' , '=' , 'Innovecto (PT Adrian Saka Arsana)')
                        ->groupBy('nama_company')
                        ->first();
                         
        $karya = DB::table('applicant')
                        ->select(DB::raw('count(*) as karya, nama_company'))
                        ->join('job_vacant', 'applicant.id_job_vacant' , '=' , 'job_vacant.id_job_vacant')
                        ->join('divisi', 'job_vacant.id_divisi', '=', 'divisi.id_divisi')
                        ->join('company', 'divisi.id_company', '=', 'company.id_company')
                        ->where('nama_company' , '=' , 'Karya (PT Krya Saka Arsana)')
                        ->groupBy('nama_company')
                        ->first();

        //INISIALISASI DATA TABLE 
        $company = \Lava::DataTable();
        $gender = \Lava::DataTable();

        //MEMASUKKAN BARIS DAN KOLOM UNTUK JUMLAH PENDAFTAR DISETIAP ORGANISASI
        $company->addStringColumn('Company')
                    ->addNumberColumn('Number')
                    ->addRow(array('Definite', $definite->definite))
                    ->addRow(array('Flipbox', $flipbox->flipbox))
                    ->addRow(array('Innovecto', $innovecto->innovecto))
                    ->addRow(array('Karya', $karya->karya))
                    ;
        //MEMASUKKAN BARIS DAN KOLOM UNTUK JUMLAH FEMALE DAN MALE YANG MENDAFTAR 
        $gender->addStringColumn('Gender')
                    ->addNumberColumn('Gender')
                    ->addRow(array('Female', $female->female))
                    ->addRow(array('Male', $male->male))
                    ;
            
        //INISIALISASI DATA JUMLAH PENDAFTAR DISETIAP ORGANIASI KE DALAM CHART
            $Chart = \Lava::PieChart('Company', $company, [
               'title' => 'TOTAL APPLICANT FOR EACH COMPANY',
                'titleTextStyle' => [
                    'color'    => '#eb6b2c',
                    'fontSize' => 18
                ]

               
            ]);

        //INISIALISASI DATA JUMLAH FEMALE DAN MALE KE DALAM CHART
            $Chart1 = \Lava::ColumnChart('Gender', $gender, [
               'title' => 'GENDER',
                'titleTextStyle' => [
                    'color'    => '#eb6b2c',
                    'fontSize' => 18
                ]

              
            ]);

        //RETURN
        return view('statistic')->with('Chart', $Chart)->with('Chart1', $Chart1);
    }


}