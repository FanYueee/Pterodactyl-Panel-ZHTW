import React, { useEffect, useState } from 'react';
import { ServerContext } from '@/state/server';
import TitledGreyBox from '@/components/elements/TitledGreyBox';
import reinstallServer from '@/api/server/reinstallServer';
import { Actions, useStoreActions } from 'easy-peasy';
import { ApplicationStore } from '@/state';
import { httpErrorToHuman } from '@/api/http';
import tw from 'twin.macro';
import { Button } from '@/components/elements/button/index';
import { Dialog } from '@/components/elements/dialog';

export default () => {
    const uuid = ServerContext.useStoreState((state) => state.server.data!.uuid);
    const [modalVisible, setModalVisible] = useState(false);
    const { addFlash, clearFlashes } = useStoreActions((actions: Actions<ApplicationStore>) => actions.flashes);

    const reinstall = () => {
        clearFlashes('settings');
        reinstallServer(uuid)
            .then(() => {
                addFlash({
                    key: 'settings',
                    type: 'success',
                    message: '您的伺服器已開始進行重新安裝。',
                });
            })
            .catch((error) => {
                console.error(error);

                addFlash({ key: 'settings', type: 'error', message: httpErrorToHuman(error) });
            })
            .then(() => setModalVisible(false));
    };

    useEffect(() => {
        clearFlashes();
    }, []);

    return (
        <TitledGreyBox title={'重新安裝伺服器'} css={tw`relative`}>
            <Dialog.Confirm
                open={modalVisible}
                title={'Confirm server reinstallation'}
                confirm={'Yes, reinstall server'}
                onClose={() => setModalVisible(false)}
                onConfirmed={reinstall}
            >
                您伺服器將有部分檔案被刪除，例如伺服器核心與其設定檔，如果有重要資料請記得先備份，重新安裝後無法還原。
            </Dialog.Confirm>
            <p css={tw`text-sm`}>
                重新安裝時您的伺服器會關閉，並執行初始創建的執行腳本。&nbsp;
                <strong css={tw`font-medium`}>
                    您伺服器將有部分檔案被刪除，例如伺服器核心與其設定檔，如果有重要資料請記得先備份，重新安裝後無法還原。
                </strong>
            </p>
            <div css={tw`mt-6 text-right`}>
                <Button.Danger variant={Button.Variants.Secondary} onClick={() => setModalVisible(true)}>
                    重新安裝伺服器
                </Button.Danger>
            </div>
        </TitledGreyBox>
    );
};
