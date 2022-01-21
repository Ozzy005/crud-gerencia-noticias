<?php

namespace App\Http\Controllers;

use App\Models\{Notice};
use App\Http\Requests\NoticeRequest;
use Illuminate\Http\Request;
use Exception;

class NoticeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $notices = Notice::where('user_id', '=', $user->id)->paginate(15);
        return view('notice.index', ['notices' => $notices]);
    }

    public function search(Request $request)
    {
        try {
            $data = $request->all();

            if (empty($data['search-type']) || $data['search-type'] != 'author' && $data['search-type'] != 'title') {
                throw new Exception("Opção Author ou Title obrigatória!");
            }

            if (empty($data['search'])) {
                throw new Exception("Campo search obrigatório!");
            }

            $user = auth()->user();
            $notices = Notice::where('user_id', '=', $user->id)
                ->where("{$data['search-type']}", '=', "{$data['search']}")
                ->paginate(15);

            return view('notice.index', ['notices' => $notices]);
        } catch (Exception $e) {
            $msg = [
                'success' => false,
                'error' => true,
                'msg' => $e->getMessage()
            ];

            return redirect('/notice')->with('msg', $msg);
        }
    }

    public function create()
    {
        return view('notice.create');
    }

    public function store(NoticeRequest $request)
    {
        $msg = [
            'success' => true,
            'error' => false,
            'msg' => 'Registro salvo com sucesso!'
        ];

        try {
            $notice = new Notice($request->all());
            $notice->user_id = auth()->user()->id;
            $notice->save();
        } catch (\Throwable $th) {
            $msg = [
                'success' => false,
                'error' => true,
                'msg' => 'Algo deu errado, tente novamente!'
            ];
        }

        return redirect('/notice')->with('msg', $msg);
    }

    public function show($id)
    {
        try {
            $user = auth()->user();
            $notice = Notice::where('id', '=', $id)
                ->where('user_id', '=', $user->id)->first();

            if (!$notice) {
                throw new Exception("Algo deu errado, tente novamente!");
            }

            return view('notice.show', ['notice' => $notice]);
        } catch (Exception $e) {
            $msg = [
                'success' => false,
                'error' => true,
                'msg' => $e->getMessage()
            ];

            return redirect('/notice')->with('msg', $msg);
        }
    }

    public function edit($id)
    {
        try {
            $user = auth()->user();
            $notice = Notice::where('id', '=', $id)
                ->where('user_id', '=', $user->id)->first();

            if (!$notice) {
                throw new Exception("Algo deu errado, tente novamente!");
            }

            return view('notice.edit', ['notice' => $notice]);
        } catch (Exception $e) {
            $msg = [
                'success' => false,
                'error' => true,
                'msg' => $e->getMessage()
            ];

            return redirect('/notice')->with('msg', $msg);
        }
    }

    public function update($id, NoticeRequest $request)
    {
        $msg = [
            'success' => true,
            'error' => false,
            'msg' => 'Registro salvo com sucesso!'
        ];

        try {
            $user = auth()->user();
            $notice = Notice::where('id', '=', $id)
                ->where('user_id', '=', $user->id)->first();

            if (!$notice) {
                throw new Exception("Algo deu errado, tente novamente!");
            }

            $notice->update($request->all());
        } catch (Exception $e) {
            $msg = [
                'success' => false,
                'error' => true,
                'msg' => $e->getMessage()
            ];
        }

        return redirect('/notice')->with('msg', $msg);
    }

    public function destroy($id)
    {
        $msg = [
            'success' => true,
            'error' => false,
            'msg' => 'Registro deletado com sucesso!'
        ];

        try {
            $user = auth()->user();
            $notice = Notice::where('id', '=', $id)
                ->where('user_id', '=', $user->id)->first();

            $notice->delete();
        } catch (\Throwable $th) {
            $msg = [
                'success' => false,
                'error' => true,
                'msg' => 'Algo deu errado, tente novamente!'
            ];
        }

        return redirect('/notice')->with('msg', $msg);
    }
}
