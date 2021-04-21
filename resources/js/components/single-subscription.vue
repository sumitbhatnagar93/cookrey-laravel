<template>
    <div>
        <div class="container">
            <h2 class="CK-center-title">My Subscription</h2>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(date,index) of subscriptionLoop">
                    <td>{{ date | formatDate }}</td>
                    <td v-bind:class="'table-'+date.color">{{ date.status }}</td>
                    <td>
                        <select class="form-control" @change="updateSubscribtion($event,date,index)"
                                v-bind:disabled="date<today">
                            <option v-bind:selected="date.status !== 'Cancelled'" value="apply">Apply Order</option>
                            <option v-bind:selected="date.status === 'Cancelled'" value="cancel">Cancel Order</option>
                        </select>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    name: "single-subscription",
    props: ['userId','subId'],
    data() {
        return {
            subscription: [],
            subscriptionLoop: [],
            canceledDates: [],
            today: new Date(),
        };
    },
    mounted() {
        this.showPreloader()
    },
    created() {
        this.getUserSubscription()
    },
    methods: {
        showPreloader() {
            this.loader = this.$loading.show({
                canCancel: true,
                onCancel: this.onCancel,
                color: '#ffffff',
                loader: 'dots',
                backgroundColor: '#000000',
            });
        },
        getUserSubscription() {
            axios.get('/getSingleSubscriptionById/' + this.userId+'/'+this.subId).then((rp) => {
                    console.log(rp.data)
                    if (rp.data.cancel_dates) {
                        this.canceledDates = JSON.parse(rp.data.cancel_dates);
                    }
                    this.subscription = rp.data
                    if (this.subscription) {
                        this.subscriptionLoop = this.getMiddleDates(
                            new Date(this.subscription.start_date),
                            new Date(this.subscription.end_date)
                        );
                        let i = 0;
                        for (const date of this.subscriptionLoop) {
                            if (this.canceledDates.indexOf(new Date(date).getTime()) !== -1) {
                                this.subscriptionLoop[i].status = 'Cancelled';
                                this.subscriptionLoop[i].color = 'danger';
                            } else {
                                if (new Date(date) > this.today) {
                                    this.subscriptionLoop[i].status = 'Upcoming';
                                    this.subscriptionLoop[i].color = 'warning';
                                } else {
                                    if (new Date(date) < this.today) {
                                        this.subscriptionLoop[i].status = 'Delivered';
                                        this.subscriptionLoop[i].color = 'success';
                                    } else {
                                        this.subscriptionLoop[i].status = 'Pending';
                                        this.subscriptionLoop[i].color = 'info';
                                    }
                                }
                            }
                            i++;
                        }
                        console.log(this.subscriptionLoop)
                    }
                    this.loader.hide()
                },
                (er) => {
                    this.loader.hide()
                    console.log(er)
                    window.location = '/'
                })
        },

        getMiddleDates(startDate, endDate) {
            let dates = [],
                currentDate = startDate,
                addDays = function (days) {
                    var date = new Date(this.valueOf());
                    date.setDate(date.getDate() + days);
                    return date;
                };
            while (currentDate <= endDate) {
                dates.push(currentDate);
                currentDate = addDays.call(currentDate, 1);
            }
            return dates;
        },

        updateSubscribtion(data, date, index) {
            let val = data.target.value;
            if (val === 'cancel') {
                this.canceledDates.push(new Date(date).getTime());
                this.subsAction().then((res) => {
                    this.subscriptionLoop[index].status = 'Cancelled';
                    this.subscriptionLoop[index].color = 'danger';
                    this.showPreloader()
                    this.getUserSubscription()
                }, (er) => {
                    console.log(er);
                });
            } else {
                const i = this.canceledDates.indexOf(new Date(date).getTime());
                this.canceledDates.splice(i, 1);
                if (new Date(date) > this.today) {
                    this.subsAction().then((res) => {
                        this.subscriptionLoop[index].status = 'Upcoming';
                        this.subscriptionLoop[index].color = 'warning';
                        this.showPreloader()
                        this.getUserSubscription()
                    }, (er) => {
                        console.log(er);
                    });
                } else {
                    this.subsAction().then((res) => {
                        this.subscriptionLoop[index].status = 'Pending';
                        this.subscriptionLoop[index].color = 'info';
                        this.showPreloader()
                        this.getUserSubscription()
                    }, (er) => {
                        console.log(er);
                    });
                }
            }
            console.log(this.subscriptionLoop[index].status);
        },

        async subsAction() {
            const formData = new FormData();
            formData.append('userId', this.userId);
            formData.append('cancel_dates', JSON.stringify(this.canceledDates));
            await axios.post('/cancelSubsDate', formData).then((res) => {
                    console.log(res);
                },
                (er) => {
                    console.log(er)
                })
        },
    }
}
</script>

<style scoped>

</style>
