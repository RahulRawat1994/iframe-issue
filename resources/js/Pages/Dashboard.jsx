import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import { usePage } from '@inertiajs/react'

export default function Dashboard({ auth }) {
   const {data} = usePage().props
    // const newData = JSON.parse(JSON.stringify(data));
    // console.log('newData',newData)
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900{{ $page['props']['data'] }}">Good Morning  </div>
                    </div>
                </div>
            </div>
            {data.map(row => (
            <div className="py-2">
                
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    
                        
                        <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg card-details ">
                            <div>#{row.id}    </div> 
                            <div>{row.fullname}    </div> 
                            <div>{row.email}    </div> 
                        </div>
                        <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg card-details ">
                            <div>{row.token}    </div>
                        </div>
                    </div>
                    
                </div>
                ))}
            
        </AuthenticatedLayout>
    );
}
