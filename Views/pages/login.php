<div class="col-span-12 h-screen primary_bg ">
        <div class="w-full h-20 flex  flex flex-col items-center border-b border-gray-900">
        <div class="flex w-10/12 mx-auto mt-5">
            <a href="history.go(-1)" class="w-6 h-6 my-auto rounded-full grid place-items-center text-gray-900 bg-gray-300 mr-4"><i class="fas fa-arrow-left"></i></a><h1 class="text-gray-300 font-bold text-2xl text-left mx-a">USALVAGETRADE</h1>
        </div>
        <h2 class="text-gray-400 w-10/12 mx-auto font-semibold text-base mx-auto pl-10 text-left">Bienvenu(e) sur universal salvage trade</h2>
    </div>
    <div class="md:w-6/12 flex flex-col justify-center items-center border mt-16 border-gray-900 mx-auto primary_bg shadow rounded p-12">
        <div class="md:w-9/12 w-full mx-auto ">
            <h2 class="text-gray-400 font-semibold text-xl my-4 text-left"> Connectez-vous sur votre compte</h2>
        </div>
        <form method="POST" action="/sign_in" class="md:w-10/12  mx-auto md:p-3">
            <div class="md:w-11/12 mx-auto border border-gray-400 rounded-lg h-10">
                <input type="text" name="username" id="username" placeholder="Nom d'utilisateur" class="w-11/12 ml-4 border-none h-full text-gray-400  bg-transparent outline-none">
            </div>
            <span class="-mt-2 text-gray-500 text-xs ml-7 mb-3 w-11/12">Le champ ci-haut est obligatoire !</span>
            <div class="md:w-11/12 mx-auto border border-gray-400 rounded-lg h-10">
                <input type="password" name="password" id="password" placeholder="Mot de passe" class="w-11/12 ml-4 border-none h-full text-gray-400  bg-transparent outline-none">
            </div>
            <span class="-mt-2 text-gray-500 text-xs ml-7 w-11/12">Le champ ci-haut est obligatoire !</span>
            <div class="md:w-11/12 flex justify-between mt-5 mx-auto">
                <div class="w-6/12 flex text-gray-500 justify-left">
                    <input class="w-4 h-4 mx-2" type="checkbox" name="remember" id="remember">
                    <label class="text-sm" for="remember">Se souvenir de moi</label>
                </div>
                <div class="w-6/12 text-gray-500">
                    <span class="flex justify-end font-semibold"><a class="text-sm" href="/reset-password">Mot de passe oublié ?</a></span>
                </div>
            </div>
            <div class="md:w-11/12 mx-auto mt-4">
                <button type="submit" class="_green_bg text-gray-900 p-2 w-full h-10 rounded"><i class="fas fa-lock"></i> Connexion</button>
            </div>
            <div class="md:w-11/12 flex text-gray-500 justify-between mt-5 mx-auto">
                <span class="flex justify-end">Pas encore inscrit(e) ? <a class="font-semibold" href="/register"> &#160; Créer un compte</a></span>
            </div>
        </form>
    </div>
</div>