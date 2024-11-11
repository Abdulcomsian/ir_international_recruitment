<a href="{{ route('quebec.legal-aspects.show', $row->id) }}" class="btn btn-info btn-sm">View</a>
<a href="{{ route('quebec.legal-aspects.edit', $row->id) }}" class="btn btn-primary btn-sm">Edit</a>

@php
    $extraButton = match ($row->type) {
        'key_navigation' => ['route' => 'quebec.legal-aspects.navigations.index', 'label' => 'Key Navigations'],
        'faq' => ['route' => 'quebec.legal-aspects.faqs.index', 'label' => 'FAQs'],
        'useful_links' => ['route' => 'quebec.legal-aspects.useful-links.index', 'label' => 'Useful Links'],
        'legal_aid' => ['route' => 'quebec.legal-aspects.legal-aids.index', 'label' => 'Legal Aids'],
        default => null,
    };
@endphp

@if ($extraButton)
    <a href="{{ route($extraButton['route'], $row->id) }}" class="btn btn-secondary btn-sm">{{ $extraButton['label'] }}</a>
@endif

