<?php
require('libs/fpdf186/fpdf.php');
require_once('includes/database.php');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID de colaborador no proporcionado.");
}

$cedula = $_GET['id'];

// Consulta la información del colaborador
$sql = "SELECT c.numero_cedula, c.nombre, c.fecha_contratacion, c.salario, cargos.name AS cargo
        FROM collaborators c
        LEFT JOIN cargos ON cargos.id = c.cargo
        WHERE c.numero_cedula = '{$cedula}' LIMIT 1";
$result = $db->query($sql);

if ($result->num_rows == 0) {
    die("Colaborador no encontrado.");
}

$collaborator = $result->fetch_assoc();

// Crear el PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Contenido del PDF
$nombre = $collaborator['nombre'];
$cargo = $collaborator['cargo'];
$salario = number_format($collaborator['salario'], 2);
$fecha = date("d/m/Y", strtotime($collaborator['fecha_contratacion']));

$texto = "A quien corresponda,\n\n";
$texto .= "Por medio de la presente, se certifica que el Sr./Sra. {$nombre}, identificado/a con cédula No. {$cedula}, labora en nuestra empresa como {$cargo}. ";
$texto .= "Ha estado en servicio desde el {$fecha} y actualmente percibe un salario mensual de \${$salario}.\n\n";
$texto .= "Esta carta se expide a petición del interesado/a para los fines que estime convenientes.\n\n";
$texto .= "Atentamente,\n\n";
$texto .= "______________________________\n";
$texto .= "Firma y Sello de la Empresa\n";

$pdf->MultiCell(0, 10, utf8_decode($texto));
$pdf->Ln(10);

// Mostrar el PDF en el navegador sin descargarlo
$pdf->Output('I', 'Carta_Laboral.pdf');
?>
