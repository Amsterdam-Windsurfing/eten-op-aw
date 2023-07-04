<?php

namespace App\Util;

use App\Models\DinnerEvent;

class EventRegistrationsPDFRenerator
{
    private $document;

    private const FONT_FAMILY = 'Arial';

    private const LABEL_COLUMN_WIDTH = 50;

    private $dinnerEvent;

    public function __construct(DinnerEvent $dinnerEvent, string $logoFile)
    {
        $this->dinnerEvent = $dinnerEvent;

        $this->document = new \FPDF();

        $this->document->AddPage();

        $this->writeHeader($logoFile);
        $this->document->Ln();
        $this->document->Ln();

        $this->writeEventDetails();
        $this->writeRegistrationsSummary();
        $this->document->Ln();
        $this->writeAllergensTable();
        $this->document->Ln();
        $this->writeRegistrationsTable();
    }

    public function getDocument()
    {
        $this->document->Output();
    }

    public function getDocumentAsString()
    {
        return $this->document->Output('S');
    }

    private function writeHeader($logoFile)
    {

        $this->document->SetFont(self::FONT_FAMILY, 'B', 16);
        $this->document->Cell(0, 10, 'Registratielijst Samen eten op Woensdag', 0, '', 'L');

        $this->document->Image($logoFile, 160, 6, 40);
    }

    private function writeEventDetails()
    {
        $this->document->SetFont(self::FONT_FAMILY, '', 11);
        $this->writeLine('Datum', \Carbon\Carbon::parse($this->dinnerEvent->date)->translatedFormat('l j F Y'));
        $this->writeLine('Rapport gegenereerd op', \Carbon\Carbon::now()->translatedFormat('l j F Y - H:i:s'));
        $this->writeLine('Naam kok', $this->dinnerEvent->cook_name);
        $this->writeLine('Omschrijving', $this->dinnerEvent->description);
        $this->document->Ln();
    }

    public function writeRegistrationsSummary()
    {
        $this->document->SetFont(self::FONT_FAMILY, 'B', 10);
        $this->document->Cell(0, 14, 'Samenvatting inschrijvingen', 0, '', 'L');
        $this->document->Ln();

        if ($this->dinnerEvent->meat_option || $this->dinnerEvent->eventRegistrationsOptions()['meat']) {
            $this->document->SetFont(self::FONT_FAMILY, '', 10);
            $this->document->cell(35, 10, ' Vlees', 1, '', 'L');
            $this->document->cell(10, 10, $this->dinnerEvent->eventRegistrationsOptions()['meat'], 1, '', 'C');
            $this->document->Ln();
        }

        if ($this->dinnerEvent->vegetarian_option || $this->dinnerEvent->eventRegistrationsOptions()['vegetarian']) {
            $this->document->cell(35, 10, ' Vegetarisch', 1, '', 'L');
            $this->document->cell(10, 10, $this->dinnerEvent->eventRegistrationsOptions()['vegetarian'], 1, '', 'C');
            $this->document->Ln();
        }

        if ($this->dinnerEvent->vegan_option || $this->dinnerEvent->eventRegistrationsOptions()['vegan']) {
            $this->document->cell(35, 10, ' Vegan', 1, '', 'L');
            $this->document->cell(10, 10, $this->dinnerEvent->eventRegistrationsOptions()['vegan'], 1, '', 'C');
            $this->document->Ln();
        }

        $this->document->cell(35, 10, ' Totaal', 1, '', 'L');
        $this->document->cell(10, 10, $this->dinnerEvent->eventRegistrationsCount(), 1, '', 'C');
        $this->document->Ln();
    }

    public function writeAllergensTable()
    {
        $this->document->SetFont(self::FONT_FAMILY, 'B', 10);
        $this->document->Cell(0, 14, 'Allegieen om rekening mee te houden', 0, '', 'L');
        $this->document->Ln();

        $this->document->SetFont(self::FONT_FAMILY, '', 8);

        foreach ($this->dinnerEvent->eventRegistrations as $eventRegistration) {
            if ($eventRegistration->registration_verified_at == null) {
                continue;
            }
            if ($eventRegistration->allergies) {
                $this->document->cell(50, 9, $eventRegistration->name, 1, '', 'L');
                $this->document->cell(140, 9, $eventRegistration->allergies, 1, '', 'L');
                $this->document->Ln();
            }
        }

        $this->document->SetFont(self::FONT_FAMILY, '', 11);
    }

    public function writeRegistrationsTable()
    {
        $this->document->SetFont(self::FONT_FAMILY, 'B', 10);
        $this->document->Cell(0, 14, 'Overzicht inschrijvingen', 0, '', 'L');
        $this->document->Ln();

        $this->document->SetFont(self::FONT_FAMILY, 'B', 8);

        $this->document->cell(136, 9, 'Naam', 1, '', 'L');
        $this->document->cell(36, 9, 'Optie', 1, '', 'C');
        $this->document->cell(18, 9, 'Betaald', 1, '', 'C');
        $this->document->Ln();

        $this->document->SetFont(self::FONT_FAMILY, '', 8);

        foreach ($this->dinnerEvent->eventRegistrations as $eventRegistration) {
            if ($eventRegistration->registration_verified_at == null) {
                continue;
            }

            $this->document->cell(136, 9, $eventRegistration->name, 1, '', 'L');
            $this->document->cell(36, 9, ['meat' => 'Vlees', 'vegetarian' => 'Vegetarisch', 'vegan' => 'Vegan'][$eventRegistration->dinner_option], 1, '', 'C');
            $this->document->cell(18, 9, '', 1, '', 'C');
            $this->document->Ln();

        }

        // write 10 extra lines for late registrations
        for ($i = 0; $i < 15; $i++) {
            $this->document->cell(136, 9, '', 1, '', 'L');
            $this->document->cell(36, 9, '', 1, '', 'C');
            $this->document->cell(18, 9, '', 1, '', 'C');
            $this->document->Ln();
        }
    }

    private function writeLine($label, $content)
    {
        $this->document->Cell(self::LABEL_COLUMN_WIDTH, 8, $label.':', 0, '', 'L');
        $this->document->MultiCell(0, 8, $content, 0, 'L');
    }
}
