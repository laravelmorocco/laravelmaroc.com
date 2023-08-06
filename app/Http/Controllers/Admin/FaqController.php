<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Language;
use App\Models\Section;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public $lang;

    public function __construct()
    {
        $this->lang = Language::where('is_default', 1)->first();
    }

    public function faq(Request $request)
    {
        $lang = Language::where('code', $request->language)->first()->id;

        $faqs = Faq::where('language_id', $lang)->orderBy('id', 'DESC')->get();

        $static = Section::where('language_id', $lang)->orderBy('id', 'DESC')->first();

        return view('admin.home.faq.index', compact('faqs', 'static'));
    }

    // Add Faq
    public function add()
    {
        return view('admin.home.faq.add');
    }

    // Store Faq
    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required|max:150',
            'content'       => 'required',
            'serial_number' => 'required|numeric',
            'language_id'   => 'required',
            'status'        => 'required',
        ]);

        $faq = new Faq();
        $faq->language_id = $request->language_id;
        $faq->status = $request->status;
        $faq->title = $request->title;
        $faq->serial_number = $request->serial_number;
        $faq->content = $request->content;
        $faq->save();

        $notification = [
            'messege' => 'Faq Added successfully!',
            'alert'   => 'success',
        ];

        return redirect()->back()->with('notification', $notification);
    }

    // Faq Delete
    public function delete($id)
    {
        $faq = Faq::find($id);
        $faq->delete();

        $notification = [
            'messege' => 'FAQ Deleted successfully!',
            'alert'   => 'success',
        ];

        return redirect()->back()->with('notification', $notification);
    }

    // Faq Edit
    public function edit($id)
    {
        $faq = Faq::find($id);

        return view('admin.home.faq.edit', compact('faq'));
    }

    // Update Faq
    public function update(Request $request, $id)
    {
        $id = $request->id;
        $request->validate([
            'title'         => 'required|max:150',
            'content'       => 'required',
            'serial_number' => 'required|numeric',
            'language_id'   => 'required',
            'status'        => 'required',
        ]);

        $faq = Faq::find($id);
        $faq->language_id = $request->language_id;
        $faq->status = $request->status;
        $faq->title = $request->title;
        $faq->serial_number = $request->serial_number;
        $faq->content = $request->content;
        $faq->save();

        $notification = [
            'messege' => 'Faq Updated successfully!',
            'alert'   => 'success',
        ];

        return redirect(route('admin.faq').'?language='.$this->lang->code)->with('notification', $notification);
    }
}
