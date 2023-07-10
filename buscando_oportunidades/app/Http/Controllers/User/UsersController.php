<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\Users\RegistrarUsuarioRequest;
use App\Http\Resources\UsersResource;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Hash;
use Storage;

/**
 * @group Usuarios
 */
class UsersController extends Controller
{
    const DEFAULT_AVATAR_FILENAME = "default_avatar.png";
    const AVATARS_FOLDER = 'avatars';

    /**
     * Obtener el usuario actual
     * @return UsersResource
     */
    public function showCurrentUser()
    {
        $user = Auth::user();
        if(!$user) abort(404);
        return new UsersResource($user);
    }

    /**
     *  Actualizar avatar de perfil
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Prodemmi\Apiful\Apiful
     * @throws \Prodemmi\Apiful\Exceptions\InvalidHttpStatusCodeSuccess
     */
    public function updateAvatarImage(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        # Verificamos si se envió en la request un archivo con el nombre 'image'
        if($request->hasFile('image')){
            # obtenemos el archivo 'image' desde la request
            $img = $request->file('image');

            # Definimos la carpeta en la que guardaremos la imagen..
            # Siempre sera en /strorage/app/ -> $path
            # --> como debe ser accedida por url, la debemos guardar en la carpeta storage/app/public
            $path = "public/" . self::AVATARS_FOLDER;

            # Guardamos la imagen subida en la carpeta del Storage indicada, nos devuelve el fullpath
            # con el nuevo nombre que se le asigna al archivo
            $filename = Storage::putFile($path, $img);
            if($filename === false){
                return apiful()->withStatusCode(409)->withMessage('No fue posible actualizar la imágen.');
            }

            # Para guardar en la db, lo ideal es guardar el link publico de la foto, es decir, un link que este listo para acceder a la foto por el cliente.
            # Para ello, vamos a obtener el link correspondiente a nuestro archivo


            # extraemos solo el nombre del archivo con su extensión. Ej: example.jpg
            $filename = basename($filename);

            // Antes de que actualicemos el modelo, extraemos el nombre del archivo anterior, desde la url
            $old_image = basename($user->photo);

            # Obtenemos el link publico para la imagen
            $storage_url = Storage::url(self::AVATARS_FOLDER .'/' . $filename);
            $public_url = \URL::to($storage_url);

            # Seteamos el link en el modelo y lo guardamos
            $user->photo = $public_url;
            $user->save();

            # Eliminamos la foto anterior
            if($old_image !== self::DEFAULT_AVATAR_FILENAME){
                Storage::delete($path.'/'.$old_image);
            }
        }

        if (!isset($public_url))
            $public_url = self::AVATARS_FOLDER.'/'.self::DEFAULT_AVATAR_FILENAME;

        return apiful()->withData([
            'link' => $public_url
        ])->success();
    }

    /**
     * Cambiar contraseña
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function changeUserPassword(Request $request )
    {
        //Para cambiar la contraseña tenemos que mandar un body-param 'password_confirmation'
        $request->validate([
            'password' => ['required', 'string', 'min:6','max:100', 'confirmed'],
            'current_password' => ['required', 'string'],
        ]);

        /** @var User $user */
        $user = Auth::user();

        // Validamos el password del usuario actual
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return apiful()->withStatusCode(401)->withMessage('Contraseña incorrecta.')->success();
        }

        // update password
        $user->password = Hash::make($request->input('password'));
        try {
            $user->saveOrFail();

            return apiful()->success();
        } catch (\Throwable $e) {
            return apiful()->withStatusCode(401)->error($e->getMessage());
        }
    }

    public function store(RegistrarUsuarioRequest $request )
    {
        // Nota: la validacion de permisos está en la request
        $data = $request->validated();

        try {
            $user = new User($data);
            $user->password = Hash::make($data['password']);
            $user->saveOrFail();

            return apiful()->withData(UsersResource::make($user))->success();
        } catch (\Throwable $e) {
            return apiful()->error($e)->send();
        }
    }
}
