@if (session()->has('alert.config') || session()->has('alert.delete.config'))
    <script>
        window.onload = function() {
            @if (session()->has('alert.config'))
                @if (session()->has('alert.config.input'))
                    Swal.fire({
                        {!! collect(session('alert.config'))
                                ->filter(function($value, $key) {
                                    return in_array($key, ['title', 'text', 'icon', 'showCancelButton', 'timer', 'timerProgressBar', 'confirmButtonText', 'denyButtonText', 'cancelButtonText', 'position', 'toast', 'backdrop', 'allowOutsideClick', 'input', 'inputPlaceholder', 'inputValue', 'showDenyButton', 'allowHtml', 'html', 'width', 'willClose', 'didClose', 'customClass', 'confirmButtonColor', 'cancelButtonColor', 'denyButtonColor'])
                                    ||
                                    starts_with($key, 'pre') || starts_with($key, 'did') || starts_with($key, 'will');
                                })
                                ->map(function($value, $key) {
                                    if ($key === 'html' && $value && is_string($value)) {
                                        return "'{$key}': '{$value}'";
                                    }
                                    
                                    if (is_bool($value)) {
                                        return "'{$key}': {$value}";
                                    }
                                    
                                    if (is_numeric($value)) {
                                        return "'{$key}': {$value}";
                                    }
                                    
                                    if (is_array($value)) {
                                        if ($key === 'customClass') {
                                            return "'{$key}': " . json_encode($value);
                                        }
                                        
                                        return "'{$key}': " . collect($value)->toJson();
                                    }
                                    
                                    if ($value instanceof \Closure) {
                                        return "'{$key}': " . $value();
                                    }

                                    if (is_string($value)) {
                                        return "'{$key}': '{$value}'";
                                    }

                                    return "'{$key}': " . json_encode($value);
                                })
                                ->implode(', ') !!}
                    }).then(function(result) {
                        if (result.isConfirmed) {
                            if (typeof @this !== 'undefined') {
                                @this.set('alertInput', result.value);
                                @this.call('{{ session('alert.config.onConfirmed') }}');
                            }
                        } else if (result.isDenied) {
                            if (typeof @this !== 'undefined') {
                                @this.call('{{ session('alert.config.onDenied') }}');
                            }
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            if (typeof @this !== 'undefined') {
                                @this.call('{{ session('alert.config.onDismissed') }}');
                            }
                        }
                    });
                @else
                    Swal.fire({
                        {!! collect(session('alert.config'))
                                ->filter(function($value, $key) {
                                    return in_array($key, ['title', 'text', 'icon', 'showCancelButton', 'timer', 'timerProgressBar', 'confirmButtonText', 'denyButtonText', 'cancelButtonText', 'position', 'toast', 'backdrop', 'allowOutsideClick', 'showDenyButton', 'allowHtml', 'html', 'width', 'willClose', 'didClose', 'customClass', 'confirmButtonColor', 'cancelButtonColor', 'denyButtonColor'])
                                    ||
                                    starts_with($key, 'pre') || starts_with($key, 'did') || starts_with($key, 'will');
                                })
                                ->map(function($value, $key) {
                                    if ($key === 'html' && $value && is_string($value)) {
                                        return "'{$key}': '{$value}'";
                                    }
                                    
                                    if (is_bool($value)) {
                                        return "'{$key}': {$value}";
                                    }
                                    
                                    if (is_numeric($value)) {
                                        return "'{$key}': {$value}";
                                    }
                                    
                                    if (is_array($value)) {
                                        if ($key === 'customClass') {
                                            return "'{$key}': " . json_encode($value);
                                        }
                                        
                                        return "'{$key}': " . collect($value)->toJson();
                                    }
                                    
                                    if ($value instanceof \Closure) {
                                        return "'{$key}': " . $value();
                                    }

                                    if (is_string($value)) {
                                        return "'{$key}': '{$value}'";
                                    }

                                    return "'{$key}': " . json_encode($value);
                                })
                                ->implode(', ') !!}
                    }).then(function(result) {
                        if (result.isConfirmed) {
                            if (typeof @this !== 'undefined') {
                                @this.call('{{ session('alert.config.onConfirmed') }}');
                            }
                        } else if (result.isDenied) {
                            if (typeof @this !== 'undefined') {
                                @this.call('{{ session('alert.config.onDenied') }}');
                            }
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            if (typeof @this !== 'undefined') {
                                @this.call('{{ session('alert.config.onDismissed') }}');
                            }
                        }
                    });
                @endif
            @endif

            @if (session()->has('alert.delete.config'))
                Livewire.on('{{ session('alert.delete.event') }}', function(component, id) {
                    Swal.fire({
                        {!! collect(session('alert.delete.config'))
                                ->filter(function($value, $key) {
                                    return in_array($key, ['title', 'text', 'icon', 'showCancelButton', 'timer', 'timerProgressBar', 'confirmButtonText', 'denyButtonText', 'cancelButtonText', 'position', 'toast', 'backdrop', 'allowOutsideClick', 'showDenyButton', 'allowHtml', 'html', 'width', 'willClose', 'didClose', 'customClass', 'confirmButtonColor', 'cancelButtonColor', 'denyButtonColor'])
                                    ||
                                    starts_with($key, 'pre') || starts_with($key, 'did') || starts_with($key, 'will');
                                })
                                ->map(function($value, $key) {
                                    if ($key === 'html' && $value && is_string($value)) {
                                        return "'{$key}': '{$value}'";
                                    }
                                    
                                    if (is_bool($value)) {
                                        return "'{$key}': {$value}";
                                    }
                                    
                                    if (is_numeric($value)) {
                                        return "'{$key}': {$value}";
                                    }
                                    
                                    if (is_array($value)) {
                                        if ($key === 'customClass') {
                                            return "'{$key}': " . json_encode($value);
                                        }
                                        
                                        return "'{$key}': " . collect($value)->toJson();
                                    }
                                    
                                    if ($value instanceof \Closure) {
                                        return "'{$key}': " . $value();
                                    }

                                    if (is_string($value)) {
                                        return "'{$key}': '{$value}'";
                                    }

                                    return "'{$key}': " . json_encode($value);
                                })
                                ->implode(', ') !!}
                    }).then(function(result) {
                        if (result.isConfirmed) {
                            if (typeof @this !== 'undefined') {
                                @this.call('{{ session('alert.delete.config.onConfirmed') }}', id);
                            }
                        } else if (result.isDenied) {
                            if (typeof @this !== 'undefined') {
                                @this.call('{{ session('alert.delete.config.onDenied') }}', id);
                            }
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            if (typeof @this !== 'undefined') {
                                @this.call('{{ session('alert.delete.config.onDismissed') }}', id);
                            }
                        }
                    });
                });
            @endif
        }
    </script>
@endif 