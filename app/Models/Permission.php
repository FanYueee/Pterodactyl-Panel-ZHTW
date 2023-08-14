<?php

namespace Pterodactyl\Models;

use Illuminate\Support\Collection;

class Permission extends Model
{
    /**
     * The resource name for this model when it is transformed into an
     * API representation using fractal.
     */
    public const RESOURCE_NAME = 'subuser_permission';

    /**
     * Constants defining different permissions available.
     */
    public const ACTION_WEBSOCKET_CONNECT = 'websocket.connect';
    public const ACTION_CONTROL_CONSOLE = 'control.console';
    public const ACTION_CONTROL_START = 'control.start';
    public const ACTION_CONTROL_STOP = 'control.stop';
    public const ACTION_CONTROL_RESTART = 'control.restart';

    public const ACTION_DATABASE_READ = 'database.read';
    public const ACTION_DATABASE_CREATE = 'database.create';
    public const ACTION_DATABASE_UPDATE = 'database.update';
    public const ACTION_DATABASE_DELETE = 'database.delete';
    public const ACTION_DATABASE_VIEW_PASSWORD = 'database.view_password';

    public const ACTION_SCHEDULE_READ = 'schedule.read';
    public const ACTION_SCHEDULE_CREATE = 'schedule.create';
    public const ACTION_SCHEDULE_UPDATE = 'schedule.update';
    public const ACTION_SCHEDULE_DELETE = 'schedule.delete';

    public const ACTION_USER_READ = 'user.read';
    public const ACTION_USER_CREATE = 'user.create';
    public const ACTION_USER_UPDATE = 'user.update';
    public const ACTION_USER_DELETE = 'user.delete';

    public const ACTION_BACKUP_READ = 'backup.read';
    public const ACTION_BACKUP_CREATE = 'backup.create';
    public const ACTION_BACKUP_DELETE = 'backup.delete';
    public const ACTION_BACKUP_DOWNLOAD = 'backup.download';
    public const ACTION_BACKUP_RESTORE = 'backup.restore';

    public const ACTION_ALLOCATION_READ = 'allocation.read';
    public const ACTION_ALLOCATION_CREATE = 'allocation.create';
    public const ACTION_ALLOCATION_UPDATE = 'allocation.update';
    public const ACTION_ALLOCATION_DELETE = 'allocation.delete';

    public const ACTION_FILE_READ = 'file.read';
    public const ACTION_FILE_READ_CONTENT = 'file.read-content';
    public const ACTION_FILE_CREATE = 'file.create';
    public const ACTION_FILE_UPDATE = 'file.update';
    public const ACTION_FILE_DELETE = 'file.delete';
    public const ACTION_FILE_ARCHIVE = 'file.archive';
    public const ACTION_FILE_SFTP = 'file.sftp';

    public const ACTION_STARTUP_READ = 'startup.read';
    public const ACTION_STARTUP_UPDATE = 'startup.update';
    public const ACTION_STARTUP_DOCKER_IMAGE = 'startup.docker-image';

    public const ACTION_SETTINGS_RENAME = 'settings.rename';
    public const ACTION_SETTINGS_REINSTALL = 'settings.reinstall';

    public const ACTION_ACTIVITY_READ = 'activity.read';

    /**
     * Should timestamps be used on this model.
     */
    public $timestamps = false;

    /**
     * The table associated with the model.
     */
    protected $table = 'permissions';

    /**
     * Fields that are not mass assignable.
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Cast values to correct type.
     */
    protected $casts = [
        'subuser_id' => 'integer',
    ];

    public static array $validationRules = [
        'subuser_id' => 'required|numeric|min:1',
        'permission' => 'required|string',
    ];

    /**
     * All the permissions available on the system. You should use self::permissions()
     * to retrieve them, and not directly access this array as it is subject to change.
     *
     * @see \Pterodactyl\Models\Permission::permissions()
     */
    protected static array $permissions = [
        'websocket' => [
            'description' => '允許用戶連接到伺服器 Websocket，以查看控制台輸出和實時伺服器統計信息。',
            'keys' => [
                'connect' => '允許用戶連接到伺服器的 Websocket 實例，以串流控制台。',
            ],
        ],

        'control' => [
            'description' => '控制用戶控制伺服器電源狀態或發送命令的權限。',
            'keys' => [
                'console' => '允許用戶通過控制台向伺服器實例發送命令。',
                'start' => '允許用戶啟動伺服器，前提是它處於停止狀態。',
                'stop' => '允許用戶停止運行中的伺服器。',
                'restart' => '允許用戶執行伺服器重啟。這允許他們在伺服器離線時啟動它，但不將伺服器完全停止。',
            ],
        ],

        'user' => [
            'description' => '允許用戶管理伺服器上的其他子用戶的權限。他們將無法編輯自己的帳戶，或分配他們自己沒有的權限。',
            'keys' => [
                'create' => '允許用戶為伺服器創建新的子用戶。',
                'read' => '允許用戶查看伺服器的子用戶及其權限。',
                'update' => '允許用戶修改其他子用戶。',
                'delete' => '允許用戶從伺服器中刪除子用戶。',
            ],
        ],

        'file' => [
            'description' => '控制用戶修改此伺服器文件系統的能力的權限。',
            'keys' => [
                'create' => '允許用戶通過面板或直接上傳創建額外的文件和文件夾。',
                'read' => '允許用戶查看目錄的內容，但不能查看文件的內容或下載文件。',
                'read-content' => '允許用戶查看特定文件的內容。這也允許用戶下載文件。',
                'update' => '允許用戶更新現有文件或文件夾的內容。',
                'delete' => '允許用戶刪除文件或目錄。',
                'archive' => '允許用戶對目錄的內容進行存檔，以及解壓系統中現有的存檔。',
                'sftp' => '允許用戶使用 SFTP 客戶端執行分配給其他文件權限的文件操作。',
            ],
        ],

        'backup' => [
            'description' => '控制用戶生成和管理伺服器備份的權限。',
            'keys' => [
                'create' => '允許用戶為此伺服器創建新備份。',
                'read' => '允許用戶查看此伺服器現有的所有備份。',
                'delete' => '允許用戶從系統中刪除備份。',
                'download' => '允許用戶下載伺服器的備份。注意：這允許用戶訪問備份中的所有文件。',
                'restore' => '允許用戶還原伺服器的備份。注意：這允許用戶在此過程中刪除所有伺服器文件。',
            ],
        ],

        // 控制編輯或查看伺服器分配的權限。
        'allocation' => [
            'description' => '控制用戶修改此伺服器的端口分配的能力的權限。',
            'keys' => [
                'read' => '允許用戶查看目前分配給此伺服器的所有分配。對該伺服器具有任何級別的存取權限的用戶總是可以查看主要分配。',
                'create' => '允許用戶為伺服器分配附加的分配。',
                'update' => '允許用戶更改主要伺服器分配並附加備註給每個分配。',
                'delete' => '允許用戶從伺服器中刪除分配。',
            ],
        ],

        // 控制編輯或查看伺服器啟動參數的權限。
        'startup' => [
            'description' => '控制用戶查看此伺服器的啟動參數的能力的權限。',
            'keys' => [
                'read' => '允許用戶查看伺服器的啟動變數。',
                'update' => '允許用戶修改伺服器的啟動變數。',
                'docker-image' => '允許用戶修改運行伺服器時使用的 Docker 映像。',
            ],
        ],

        'database' => [
            'description' => '控制用戶訪問此伺服器的數據庫管理的權限。',
            'keys' => [
                'create' => '允許用戶為此伺服器創建新數據庫。',
                'read' => '允許用戶查看與此伺服器關聯的數據庫。',
                'update' => '允許用戶旋轉數據庫實例的密碼。如果用戶沒有“查看密碼”權限，則將無法查看更新後的密碼。',
                'delete' => '允許用戶從此伺服器中刪除數據庫實例。',
                'view_password' => '允許用戶查看與此伺服器的數據庫實例關聯的密碼。',
            ],
        ],

        'schedule' => [
            'description' => '控制用戶訪問此伺服器的排程管理的權限。',
            'keys' => [
                'create' => '允許用戶為此伺服器創建新排程。',
                'read' => '允許用戶查看此伺服器的排程及其相關的任務。',
                'update' => '允許用戶更新此伺服器的排程和排程任務。',
                'delete' => '允許用戶刪除此伺服器的排程。',
            ],
        ],

        'settings' => [
            'description' => '控制用戶訪問此伺服器的設置的權限。',
            'keys' => [
                'rename' => '允許用戶重新命名此伺服器並更改其描述。',
                'reinstall' => '允許用戶觸發此伺服器的重新安裝。',
            ],
        ],

        'activity' => [
            'description' => '控制用戶訪問伺服器活動日誌的權限。',
            'keys' => [
                'read' => '允許用戶查看伺服器的活動日誌。',
            ],
        ],
    ];

    /**
     * 返回用戶在控制伺服器時系統中可用的所有權限。
     */

    public static function permissions(): Collection
    {
        return Collection::make(self::$permissions);
    }
}
