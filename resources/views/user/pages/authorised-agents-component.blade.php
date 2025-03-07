<main class="cAJbgc" style="margin-top: 0px;">
    <section id="inner_banner"
        style="background-image: url(https://www.gokite.travel/wp-content/uploads/2023/12/UMRAH-05-2.webp);">
        <div class="container">
            <h1>Authorised Agents</h1>
        </div>
    </section>
    <div id="myChart" class="chart--container" wire:ignore></div>
    <div class="container">
        <div class="py-5">
            <div class="row">
                <div class="col-6 py-5">
                    <div class="form-group">
                        <label>{{ __('tablevars.state') }} {{ __('tablevars.name') }}</label>
                        <select class="form-control" wire:model='state_id' wire:change='getAgent'>
                            <option value="">{{ __('tablevars.select') }} {{ __('tablevars.state') }}</option>
                            @foreach ($states as $states)
                                <option data-code="{{$states->state_code}}" value="{{ $states->id }}">{{ $states->state_name }}</option>
                            @endforeach
                        </select>
                        @error('state_id')
                            <span class="v-msg-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card">
                @if ($this->state_id)
                    <div class="card-header text-center">
                        <h4>{{ $state->state_name }} Authorize Agent List</h4>
                    </div>

                    <div class="card-body">
                        {{-- {{dd($agents)}} --}}
                        <div class="table-responsive text-left">
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>{{ __('tablevars.#') }}</th>
                                        <th>{{ __('tablevars.agency') }} {{ __('tablevars.name') }}</th>
                                        <th>{{ __('tablevars.name') }}</th>
                                        <th>{{ __('tablevars.city') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($agents as $key => $agent)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $agent->agency_name ?? '---' }}</td>
                                            <td>{{ $agent->owner_name ?? '---' }}</td>
                                            <td>{{ $agent->city ?? '---' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" align="center" class="v-msg">
                                                {{ __('tablevars.no_record') }}
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>
@push('extra_css')
    <style>
        .chart--container {
            min-height: 1300px;
            width: 100%;
            height: 700px;
        }

        .zc-ref {
            display: none;
        }

        #myChart-license-text {
            opacity: 0 !important;
        }
    </style>
@endpush
@push('extra_js')
    <script>
        ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "b55b025e438fa8a98e32482b5f768ff5"];
        let chartConfig = {
            shapes: [{
                    type: 'zingchart.maps',
                    options: {
                        bbox: [67.177, 36.494, 98.403,
                            6.965
                        ], // get bbox from zingchart.maps.getItemInfo('world-countries','ind');
                        ignore: ['IND'], // ignore India because we are rendering a more specific India map below
                        name: 'world.countries',
                        panning: false, // turn of zooming. Doesn't work with bounding box
                        style: {
                            tooltip: {
                                borderColor: '#000',
                                borderWidth: '1px',
                                fontSize: '18px'
                            },
                            controls: {
                                visible: false // turn of zooming. Doesn't work with bounding box
                            },
                            hoverState: {
                                alpha: .28
                            }
                        },
                        zooming: false // turn of zooming. Doesn't work with bounding box
                    }
                },
                {
                    type: 'zingchart.maps',
                    options: {
                        name: 'ind',
                        panning: false, // turn of zooming. Doesn't work with bounding box
                        zooming: false,
                        scrolling: false,
                        style: {
                            tooltip: {
                                borderColor: '#000',
                                borderWidth: '1px',
                                fontSize: '18px'
                            },
                            borderColor: '#000',
                            borderWidth: '1px',
                            controls: {
                                visible: false, // turn of zooming. Doesn't work with bounding box

                            },
                            hoverState: {
                                alpha: .28
                            },
                            items: {
                                JK: {
                                    tooltip: {
                                        text: '',
                                    },
                                    backgroundColor: '#bbff99',
                                    label: {
                                        visible: true
                                    }
                                },
                                GA: {
                                    tooltip: {
                                        text: '',
                                    },
                                    backgroundColor: '#00e6e6',
                                    label: {
                                        visible: true
                                    }
                                },
                                CT: {
                                    tooltip: {
                                        text: '',
                                    },
                                    backgroundColor: '#ff5722',
                                    label: {
                                        visible: true
                                    }
                                },
                                HP: {
                                    tooltip: {
                                        text: '',
                                    },
                                    backgroundColor: '#ff4d4d',
                                    label: {
                                        visible: true
                                    }
                                },
                                CH: {
                                    tooltip: {
                                        text: '',
                                    },
                                    backgroundColor: '#00ae4d',
                                    label: {
                                        visible: true
                                    }
                                },
                                PB: {
                                    tooltip: {
                                        text: '',
                                    },
                                    backgroundColor: '#ff9800',
                                    label: {
                                        visible: true
                                    }
                                },
                                UT: {
                                    tooltip: {
                                        text: '',
                                    },
                                    backgroundColor: '#ff5722',
                                    label: {
                                        visible: true
                                    }
                                },
                                HR: {
                                    tooltip: {
                                        text: '',
                                    },
                                    backgroundColor: '#ff5722',
                                    label: {
                                        visible: true
                                    }
                                },
                                DL: {
                                    tooltip: {
                                        text: '',
                                    },
                                    backgroundColor: '#00e6e6',
                                    label: {
                                        visible: true
                                    }
                                },
                                UP: {
                                    tooltip: {
                                        text: '',
                                    },
                                    backgroundColor: '#cccccc',
                                    label: {
                                        visible: true
                                    }
                                },
                                RJ: {
                                    tooltip: {
                                        text: '',
                                    },
                                    backgroundColor: '#00bcd4',
                                    label: {
                                        visible: true
                                    }
                                },
                                BR: {
                                    tooltip: {
                                        text: '',
                                    },
                                    backgroundColor: '#80ffaa',
                                    label: {
                                        visible: true
                                    }
                                },
                                MP: {
                                    tooltip: {
                                        text: '',
                                    },
                                    backgroundColor: '#b3ffb3',
                                    label: {
                                        visible: true
                                    }
                                },
                                GJ: {
                                    tooltip: {
                                        text: '',
                                    },
                                    backgroundColor: '#ffff52',
                                    label: {
                                        visible: true
                                    }
                                },
                                OR: {
                                    tooltip: {
                                        text: '',
                                    },
                                    backgroundColor: '#ffb3b3',
                                    label: {
                                        visible: true
                                    }
                                },

                                WB: {
                                    tooltip: {
                                        text: '',
                                    },
                                    backgroundColor: '#00e6e6',
                                    label: {
                                        visible: true
                                    }
                                },
                                AP: {
                                    tooltip: {
                                        text: '',
                                    },
                                    backgroundColor: '#ff5722',
                                    label: {
                                        visible: true
                                    }
                                },
                                SK: {
                                    tooltip: {
                                        text: '',
                                    },
                                    backgroundColor: '#00AE4D',
                                    label: {
                                        visible: true
                                    }
                                },
                                AR: {
                                    tooltip: {
                                        text: '',
                                    },
                                    backgroundColor: '#bfbfbf',
                                    label: {
                                        visible: true
                                    }
                                },
                                AS: {
                                    tooltip: {
                                        text: '',
                                    },
                                    backgroundColor: '#ffe6e6',
                                    label: {
                                        visible: true
                                    }
                                },
                                ML: {
                                    tooltip: {
                                        text: '',
                                    },
                                    backgroundColor: '#ff5722',
                                    label: {
                                        visible: true
                                    }
                                },
                                NL: {
                                    tooltip: {
                                        text: '',
                                    },
                                    backgroundColor: '#ff5722',
                                    label: {
                                        visible: true
                                    }
                                },
                                MN: {
                                    tooltip: {
                                        text: '',
                                    },
                                    backgroundColor: '#00bcd4',
                                    label: {
                                        visible: true
                                    }
                                },
                                TR: {
                                    tooltip: {
                                        text: '',
                                    },
                                    backgroundColor: '#ff5722',
                                    label: {
                                        visible: true
                                    }
                                },
                                MZ: {
                                    tooltip: {
                                        text: '',
                                    },
                                    backgroundColor: '#ff5722',
                                    label: {
                                        visible: true
                                    }
                                },
                                JH: {
                                    tooltip: {
                                        text: '',
                                    },
                                    backgroundColor: '#ff5722',
                                    label: {
                                        visible: true
                                    }
                                },
                                KA: {
                                    tooltip: {
                                        text: '',
                                    },
                                    backgroundColor: '#ff5050',
                                    label: {
                                        visible: true
                                    }
                                },
                                DN: {
                                    tooltip: {
                                        text: '',
                                    },
                                    backgroundColor: '#00bcd4',
                                    label: {
                                        visible: true
                                    }
                                },
                                MH: {
                                    tooltip: {
                                        text: '',
                                    },
                                    backgroundColor: '#ff9800',
                                    label: {
                                        visible: true
                                    }
                                },
                                TL: {
                                    tooltip: {
                                        text: '',
                                    },
                                    backgroundColor: '#00AE4D',
                                    label: {
                                        visible: true
                                    }
                                },
                                KL: {
                                    tooltip: {
                                        text: '',
                                    },
                                    backgroundColor: '#00AE4D',
                                    label: {
                                        visible: true
                                    }
                                },
                                TN: {
                                    tooltip: {
                                        text: '',
                                    },
                                    backgroundColor: '#00bcd4',
                                    label: {
                                        visible: true
                                    }
                                },
                                PY: {
                                    tooltip: {
                                        text: '',
                                    },
                                    backgroundColor: '#ff4d4d',
                                    label: {
                                        visible: true
                                    }
                                }
                            },
                            label: { // text displaying. Like valueBox
                                fontSize: '15px',
                                visible: false
                            }
                        }
                    }
                }
            ]
        };
        zingchart.bind('myChart', 'shape_click', function(e) {
            // console.log(e);
            console.log(e.shapeid);
            // @this.set('state_id',25);
            // Livewire.dispatch('setStateForChange', e.shapeid);
            // $("#state_id").val(e.shapeid).trigger();
            // let $select = $('#state_id');
            // let $option = $select.find(`option[data-code="${e.shapeid}"]`);

            // console.log('Option found:', $option, 'Value:', $option.val());

            // if ($option.length > 0) {
            //     $select.val($option.val()).trigger('change');
            // }
        });
        zingchart.loadModules('maps,maps-ind');
        zingchart.render({
            id: 'myChart',
            data: chartConfig,
            height: '100%',
            width: '100%',
        });
    </script>
@endpush
