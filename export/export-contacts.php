<?php
require_once "../config.php";
require_once "../model/emergency_model.php";
require_once '../libs/tcpdf/tcpdf.php';

// Create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator('Weather App');
$pdf->SetAuthor('Weather App');
$pdf->SetTitle('Emergency Contacts');

// Remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', '', 12);

$categories = get_contact_categories();

// Add title
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 15, 'Emergency & Disaster Management Contacts', 0, 1, 'C');
$pdf->Ln(10);

while ($category = $categories->fetch_assoc()) {
    $pdf->SetFont('helvetica', 'B', 14);
    $pdf->Cell(0, 10, $category['category'], 0, 1);
    $pdf->SetFont('helvetica', '', 12);
    
    $contacts = get_emergency_contacts_by_category($category['category']);
    
    while ($contact = $contacts->fetch_assoc()) {
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(0, 8, $contact['organization'], 0, 1);
        $pdf->SetFont('helvetica', '', 11);
        
        if ($contact['contact_name']) {
            $pdf->Cell(0, 6, 'Contact: ' . $contact['contact_name'], 0, 1);
        }
        if ($contact['phone1']) {
            $pdf->Cell(0, 6, 'Phone: ' . $contact['phone1'], 0, 1);
        }
        if ($contact['phone2']) {
            $pdf->Cell(0, 6, 'Alt Phone: ' . $contact['phone2'], 0, 1);
        }
        if ($contact['email']) {
            $pdf->Cell(0, 6, 'Email: ' . $contact['email'], 0, 1);
        }
        if ($contact['website']) {
            $pdf->Cell(0, 6, 'Website: ' . $contact['website'], 0, 1);
        }
        if ($contact['location']) {
            $pdf->Cell(0, 6, 'Location: ' . $contact['location'], 0, 1);
        }
        
        $pdf->Ln(5);
    }
    $pdf->Ln(10);
}

// Output PDF
$pdf->Output('emergency_contacts.pdf', 'D');
?>