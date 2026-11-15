<?php

namespace App\Http\Controllers;

use App\Models\TemplateHeaderSection;
use App\Models\TemplateHeaderRepeaterField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TemplateHeaderController extends Controller
{
    /**
     * Menampilkan daftar template header sections dan repeater fields.
     */
    public function index()
    {
        $templateHeaderSections = TemplateHeaderSection::with('repeaterFields')
            ->orderBy('id_template_header', 'desc')
            ->get();

        return view('template-header.index-template-header', compact('templateHeaderSections'));
    }

    /**
     * Menyimpan section baru beserta repeater fields ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:text,textarea,repeater,list,richtext',
            'repeater_fields' => 'nullable|array',
            'repeater_fields.*.label' => 'required_with:repeater_fields|string|max:255',
            'repeater_fields.*.name' => 'required_with:repeater_fields|string|max:100',
            'repeater_fields.*.type' => 'required_with:repeater_fields|in:text,textarea,date,number,email,url,richtext',
        ], [
            'title.required' => 'Judul section wajib diisi.',
            'type.required' => 'Tipe section wajib dipilih.',
            'type.in' => 'Tipe section yang dipilih tidak valid.',
            'repeater_fields.*.label.required_with' => 'Label pada repeater field wajib diisi.',
            'repeater_fields.*.name.required_with' => 'Key/Name pada repeater field wajib diisi.',
            'repeater_fields.*.type.required_with' => 'Tipe data pada repeater field wajib dipilih.',
        ]);

        DB::transaction(function () use ($validated, $request) {
            $section = TemplateHeaderSection::create([
                'title' => $validated['title'],
                'type' => $validated['type'],
            ]);

            // Jika bertipe repeater dan ada sub-fields yang diinput
            if ($section->type === 'repeater' && !empty($request->repeater_fields)) {
                foreach ($request->repeater_fields as $field) {
                    if (empty($field['label']) || empty($field['name'])) {
                        continue;
                    }

                    $cleanName = Str::snake(preg_replace('/[^a-zA-Z0-9_]/', '_', $field['name']));

                    TemplateHeaderRepeaterField::create([
                        'id_template_header' => $section->id_template_header,
                        'label' => $field['label'],
                        'name' => $cleanName ?: 'field_' . uniqid(),
                        'type' => $field['type'] ?? 'text',
                    ]);
                }
            }
        });

        return redirect()
            ->route('template-header.index')
            ->with('success', 'Template Header Section berhasil dibuat!');
    }

    /**
     * Memperbarui data section dan repeater fields terkait.
     */
    public function update(Request $request, $id)
    {
        $section = TemplateHeaderSection::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:text,textarea,repeater,list,richtext',
            'repeater_fields' => 'nullable|array',
            'repeater_fields.*.label' => 'required_with:repeater_fields|string|max:255',
            'repeater_fields.*.name' => 'required_with:repeater_fields|string|max:100',
            'repeater_fields.*.type' => 'required_with:repeater_fields|in:text,textarea,date,number,email,url,richtext',
        ], [
            'title.required' => 'Judul section wajib diisi.',
            'type.required' => 'Tipe section wajib dipilih.',
            'type.in' => 'Tipe section yang dipilih tidak valid.',
            'repeater_fields.*.label.required_with' => 'Label pada repeater field wajib diisi.',
            'repeater_fields.*.name.required_with' => 'Key/Name pada repeater field wajib diisi.',
            'repeater_fields.*.type.required_with' => 'Tipe data pada repeater field wajib dipilih.',
        ]);

        DB::transaction(function () use ($section, $validated, $request) {
            $section->update([
                'title' => $validated['title'],
                'type' => $validated['type'],
            ]);

            // Selalu hapus sub-fields lama untuk menyinkronkan data baru
            $section->repeaterFields()->delete();

            // Jika tipe section adalah repeater, masukkan kembali sub-fields yang diperbarui
            if ($section->type === 'repeater' && !empty($request->repeater_fields)) {
                foreach ($request->repeater_fields as $field) {
                    if (empty($field['label']) || empty($field['name'])) {
                        continue;
                    }

                    $cleanName = Str::snake(preg_replace('/[^a-zA-Z0-9_]/', '_', $field['name']));

                    TemplateHeaderRepeaterField::create([
                        'id_template_header' => $section->id_template_header,
                        'label' => $field['label'],
                        'name' => $cleanName ?: 'field_' . uniqid(),
                        'type' => $field['type'] ?? 'text',
                    ]);
                }
            }
        });

        return redirect()
            ->route('template-header.index')
            ->with('success', 'Template Header Section berhasil diperbarui!');
    }

    /**
     * Menghapus section beserta repeater fields terkait.
     */
    public function destroy($id)
    {
        $section = TemplateHeaderSection::findOrFail($id);
        
        // Hapus section (repeaterFields akan otomatis terhapus karena cascadeOnDelete di foreign key)
        $section->delete();

        return redirect()
            ->route('template-header.index')
            ->with('success', 'Template Header Section berhasil dihapus!');
    }
}

