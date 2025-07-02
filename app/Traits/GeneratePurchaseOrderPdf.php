<?php

namespace App\Traits;

trait GeneratePurchaseOrderPdf
{
    public function GeneratePurchaseOrderPdf($purchaseOrder, $products, $supplier, $total)
    {
        try {
            $data = [
                'purchaseOrder' => $purchaseOrder,
                'products' => $products,
                'supplier' => $supplier,
                'total' => $total,
                'date' => now(),
                'time' => now()->format('H:i'),
            ];


            $pdf = app('dompdf.wrapper');
            $pdf->loadView('livewire.pages.admin.purchase-order-pdf', $data)
                ->setPaper('a4', 'portrait')
                ->setOptions([
                    'defaultFont' => 'Helvetica',
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true,
                    'isPhpEnabled' => true,
                    'chroot' => base_path(),
                    'tempDir' => storage_path('app/temp')
                ]);


            if (!file_exists(storage_path('app/temp'))) {
                mkdir(storage_path('app/temp'), 0755, true);
            }


            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->output();
            }, 'orden-compra-' . $purchaseOrder->id . '.pdf');
        } catch (\Throwable $th) {
            $this->dispatch('showAlert', [
                'type' => 'error',
                'message' => 'Hubo un error al generar la orden'
            ]);
        }
    }
}
