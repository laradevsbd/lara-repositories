[![Issues](https://img.shields.io/github/issues/laradevsbd/lara-repositories.svg?style=flat-square)](https://github.com/laradevsbd/lara-repositories/issues)
[![Stars](https://img.shields.io/github/stars/laradevsbd/lara-repositories.svg?style=flat-square)](https://github.com/laradevsbd/lara-repositories/stargazers)
[![Forks](https://img.shields.io/github/forks/laradevsbd/lara-repositories.svg?style=flat-square)](https://github.com/laradevsbd/lara-repositories/network/members)


Laravel <span style="color:orange;"> **Repositories**</span>  is a package for Laravel  which is used to abstract the database layer.

##### This package is compatible with Laravel  7.* 8.* 9.*

###### Installation

    composer require laradevsbd/lara-repositories


Once this operation completes, the final step is to add the service provider. Open config/app.php, and add a new item to the providers array.
   
    'providers' => [
    
            // .........................
            \Laradevsbd\Repository\LaradevsbdRepositoryServiceProvider::class,,
    
        ]
        
       

Now, you need to publish service provider for extend **App\Repositories\BaseRepository.php**


    php artisan vendor:publish
   
    or
    
    php artisan vendor:publish --provider="Laradevsbd\Repository\LaradevsbdRepositoryServiceProvider"
    
# Usages

##### Create an console class

    php artisan make:repository UserRepository
    

Now Check directory **App\Repositories\UserRepository.php** and add the model class


    <?php
    
    namespace App\Repositories;
    
    class UserRepository extends BaseRepository
    {
        /**
         * @return string
         *  Return the model
         */
         //php artisan make:repository repositoryName
        public function model()
        {
            return User::class;
        }
    
        public function getFieldsSearchable()
        {
                // TODO: Implement getFieldsSearchable() method.
        }
    
        public function store($input)
        {
                // TODO: Implement
        }
    
        public function update($input, $id)
        {
                // TODO: Implement
        }
        
        // you can create any name of method
        
        public function inactive_user()
        {
         
            return User::query()->where('status',0)->get();
         
        }
    }
    
 
 Finally, Implement into **UserRepository** into **UserController**
 
        <?php
        
        namespace App\Http\Controllers;
        
        use App\Repositories\UserRepository;
        use Illuminate\Http\Request;
        
        class UserController extends Controller
        {
            /** @var UserRepository */
            private $userRepository;
        
            /**
             * Create a new controller instance.
             *
             * @param UserRepository $userRepository
             */
        
            public function __construct(UserRepository $userRepository)
            {
                $this->userRepository = $userRepository;
            }
        
            public function index()
            {
                $users=$this->userRepository->all();
                return view('users.index');
            }
        
            public function store(Request $request)
            {
                return $this->userRepository->store($request->all());
            }
        
            public function update($id,Request $request)
            {
                return $this->userRepository->update($request->all(),$id);
            }
        
            public function inactive_users()
            {
                return $this->userRepository->inactive_user();
            }
        }

# Available Methods
The following methods are available:

    public function all($columns = array('*'))
    public function paginate($perPage = 1, $columns = array('*'));
    public function create(array $data)
    public function update(array $data, $id, $attribute = "id")
    public function delete($id)
    public function find($id, $columns = array('*'))

# Example

Create a new UserRepository:

    $this->userRepository->create(Input::all());
    
Update a UserRepository:

    $this->userRepository->update(Input::all(),$id);
    
Find a UserRepository:

    $this->userRepository->find($id);
    
    
Delete a UserRepository:

    $this->userRepository->delete($id);
    
# Contact

Open an issue on GitHub if you have any problems or suggestions.

# License

The contents of this repository is released under the [MIT license](https://opensource.org/licenses/MIT)

# Visit Our Website

[www.laradevsbd.com](https://laradevsbd.com/)

# Conclusion

I am trying to help another artisan to complete their project by using a repository, which they wanna use to Laravel contract. This makes applications much easier to maintain.
