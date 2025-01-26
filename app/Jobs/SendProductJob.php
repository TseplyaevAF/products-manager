<?php

namespace App\Jobs;

use App\Http\Webhooks\ProductWebhook;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendProductJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $product = Product::find(Product::max('id'));
        $webhook = new ProductWebhook($product);
        $webhook->url(config('products.webhook'))
            ->withSignature('x-key', 'value_to_hash')
            ->send();
    }
}
