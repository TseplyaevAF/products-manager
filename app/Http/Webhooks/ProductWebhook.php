<?php

namespace App\Http\Webhooks;

use Bencoderus\Webhook\Webhooks\BaseWebhook;

class ProductWebhook extends BaseWebhook
{
    /**
    * Webhook event name.
    */
    protected $event = 'webhook.name';

    /**
     * Webhook payload.
     *
     * @return array
     */
    public function data(): array
    {
        $statuses = config('products.statuses');
        return [
            'id' => $this->id,
            'article' => $this->article,
            'name' => $this->name,
            'status' => $statuses[$this->status]['title'],
            'data' => json_decode($this->data),
            'create_date' => $this->created_at->format('d.m.Y h:m:s'),
            'update_date' => $this->updated_at->format('d.m.Y h:m:s'),
        ];
    }
}
