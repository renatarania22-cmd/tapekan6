<div style="padding: 12px; border: 1px solid {{ $type === 'error' ? 'red' : 'green' }}; background-color: {{ $type === 'error' ? '#f8d7da' : '#d4edda' }}; color: {{ $type === 'error' ? '#721c24' : '#155724' }}; margin: 10px 0; border-radius: 4px;">
    <strong>{{ ucfirst($type) }}:</strong> {{ $message }}
</div>