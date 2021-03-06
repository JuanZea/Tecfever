<?php

namespace App\Jobs;

use App\Helpers\Detectors;
use App\Product;
use App\Report;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class GenerateReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $date;
    private $name;

    /**
     * Create a new job instance.
     *
     * @param $date
     * @param $name
     */
    public function __construct($date, $name)
    {
        $this->date = $date;
        $this->name = $name;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Stats
        $products = Product::query()->orderBy('stock','DESC')->get()->toArray();
        $mostViewedProducts = Detectors::maxProductsStats($products, [], 'views');
        $bestSellers = Detectors::maxProductsStats($products, [], 'sales');
        $mostStock = Detectors::mostStock($products);

        // PDF
        $options = new Options();
        $options->set('defaultFont', 'Courier');
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml(view('reports.layoutPDF', [
            'date' => $this->date,
            'name' => $this->name,
            'mostViewedProducts' => $mostViewedProducts,
            'bestSellers' => $bestSellers,
            'mostStock' => $mostStock,
        ]));
        $dompdf->setPaper('A4');
        $dompdf->render();
        Storage::disk('reports')->put('/'.$this->name.'.pdf', $dompdf->output());

        Report::create([
            'name' => $this->name
        ]);
    }
}
