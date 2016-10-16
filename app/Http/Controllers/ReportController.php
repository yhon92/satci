<?php

namespace SATCI\Http\Controllers;

use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use SATCI\Http\Controllers\Controller;
use SATCI\Repositories\CitizenRepo;
use SATCI\Repositories\InstitutionRepo;

/**
 * Modelo de configuración para el objecto de numeración de página 
 * segun el tipo de página
 * 
 * Para: letter
 * $canvas->page_text(681, 50, "Pág: {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));
 *
 * Para: legal
 * $canvas->page_text(898, 50, "Pág: {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));
 **/

class ReportController extends Controller
{
  protected $domPdf;
  protected $citizenRepo;
  protected $institutionepo;

  public function __construct(PDF $domPdf, CitizenRepo $citizenRepo, InstitutionRepo $institutionRepo)
  {
    $this->middleware('jwt.auth');
    $this->domPdf = $domPdf;
    $this->citizenRepo = $citizenRepo;
    $this->institutionRepo = $institutionRepo;
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $title = 'Lista de Solicitantes Naturales';
    $citizens = $this->citizenRepo->all();

    $pdf = $this->domPdf->loadView('report.listApplicant', compact('citizens', 'title'));
    $pdf->setPaper('letter', 'landscape');
    $pdf->output();

    $dom_pdf = $pdf->getDomPDF();
    $canvas = $dom_pdf->get_canvas();
    $canvas->page_text(681, 50, "Pág: {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

    return $pdf->download('Listado de Solicitantes.pdf');
  }

  public function listApplicant(Request $request)
  {
    $applicant_type = ucwords($request->applicant_type);
    $parish = $request->parish;

    if ($applicant_type === 'Citizen') {

      $citizens = $this->citizenRepo->getListCitizens($parish);
      $title = 'Lista de Solicitantes Naturales';
      $template = 'report.listCitizens';
      $applicant = 'citizens';

    } elseif ($applicant_type === 'Institution') {

      $institutions = $this->institutionRepo->getListInstitutions($parish);
      $title = 'Lista de Solicitantes Jurídicos';
      $template = 'report.listInstitutions';
      $applicant = 'institutions';

    } else {
      return response()->json('Solicitante Inválido', 404);
    }

    $pdf = $this->domPdf->loadView($template, compact($applicant, 'title'));
    $pdf->setPaper('legal', 'landscape');        
    $pdf->output();

    $dom_pdf = $pdf->getDomPDF();
    $canvas = $dom_pdf->get_canvas();
    $canvas->page_text(898, 50, "Pág: {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

    return $pdf->stream($title + '.pdf');
  }
}
