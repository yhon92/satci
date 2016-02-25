<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Asignación de Solicitud</title>
</head>
<body>
  <div style="text-align: center">
    <div style="display: inline-block; padding: 0 2em;">
      <img src="http://i.imgur.com/bJSHfNM.png" alt="Alcaldía de Jiménez" width="255">
    </div>
    <div style="display: inline-block; vertical-align: top; padding: 0 2em;">
      <p style="margin: 2em 0 .5em 0">ALCALDÍA DEL MUNICIPIO JIMÉNEZ</p>
      <p style="margin: 0;">OFICINA DE ATENCIÓN AL CIUDADANO</p>
    </div>
  </div>
  <div style="padding-top: 2em">
    <div style="text-align: right;">Quíbor; {!! \Carbon\Carbon::parse($assignment['created_at'])->format('d-m-Y') !!}</div>
    <div style="padding-top: 1em">
      <p style="margin: 0;"><strong>Ciudadano:</strong></p>
      <p style="margin: 0;">{!! $assignment['area_means']['area']['director']['full_name'] !!}</p>
      <p style="margin: 0;">{!! $assignment['area_means']['area']['name'] !!}</p>
      <p style="margin: 0;">Su Despacho.-</p>
    </div>
  </div>
  <div>
    <p style="text-align: justify; text-indent: 3em; line-height: 2em;">
      En atención a las responsabilidades y demandas de la Oficina de Atención al Ciudadano, por medio del presente me dirijo a usted en la oportunidad de remitir correspondencia 
      <strong>Nº {!! $assignment['solicitude']['solicitude_number'] !!}</strong> concerniente a 
      <strong>{!! $assignment['theme']['name'] !!}</strong> a 
      nombre de <strong>{!! $assignment['solicitude']['applicant']['full_name'] !!}</strong>, 
      @if ($assignment['solicitude']['applicant_type'] === 'SATCI\Entities\Citizen')
        C.I.: 
      @elseif ($assignment['solicitude']['applicant_type'] === 'SATCI\Entities\Institution')
        R.I.F.: 
      @endif
      <strong>{!! $assignment['solicitude']['applicant']['identification'] !!}</strong>, 
      Dirección: <strong>{!! $assignment['solicitude']['applicant']['address'] !!}</strong>, 
      Teléfono: <strong>{!! $assignment['solicitude']['applicant']['prefix_phone'] !!}-{!! $assignment['solicitude']['applicant']['number_phone'] !!}</strong>, recibida por este despacho en 
      fecha <strong>{!! \Carbon\Carbon::parse($assignment['solicitude']['reception_date'])->format('d-m-Y') !!}</strong>, la cual tiene como 
      asunto: <strong>{!! $assignment['solicitude']['topic'] !!}</strong>, con la finalidad de que sea atendida por su unidad.
    </p>
    <p style="text-align: justify; text-indent: 3em; line-height: 2em;">
      Así mismo, solicitamos de sus buenos oficios, sea remitida por esta misma vía, la respuesta (atendido, en revisión, rechazado, otro) a esta solicitud en un lapso máximo de  cinco (5) día hábiles,  para  poder dar una pronta y  oportuna repuesta al solicitante, y llevar el registro actualizado de las atenciones efectuadas por la Alcaldía.  
    </p>
    <p style="text-align: justify; text-indent: 3em; line-height: 2em;">
      Sin más a que hacer referencia, queda de Ud.
    </p>
  </div>
  <div style="text-align: center">
    <p>Atentamente,</p>
    <p style="margin: 0;"><strong>Lcda. Yardelys Gil</strong></p>
    <p style="margin: 0;">COORD. DE LA OFICINA DE ATENCIÓN AL CIUDADANO</p>
    <p style="margin: 0; font-size: .9em;">Adscrito al Despacho del Alcalde</p>
    <p style="margin: 0; font-size: .9em;">Resolución Nº A-2015-003 de Fecha 08-01-2015</p>
    <p style="margin: 0; font-size: .9em;">Publicado en Gaceta Ordinaria Nº 02</p>
  </div>
</body>
</html>