<p>Transaction <span class="font-mono tracking-tight select-all">{{ $notification->data['transaction_id'] }}</span> updated from R$ {{ number_format($notification->data['from'] / 100, 2) }} to R$ {{ number_format($notification->data['to'] / 100, 2) }}</p>
